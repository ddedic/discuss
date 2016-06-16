<?php

namespace Laravelish\Discuss\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Arr;
use Laravelish\Discuss\Author\Author;
use Laravelish\Discuss\Comments\Comment;
use Laravelish\Discuss\Comments\Moderator;
use Laravelish\Discuss\Events\CommentWasUpdated;
use Laravelish\Discuss\Events\CommentWillBeSaved;

class UpdateComment extends Job implements SelfHandling
{
    /**
     * @var \Laravelish\Discuss\Comments\Comment
     */
    protected $comment;

    /**
     * @var array
     */
    protected $input;

    /**
     * Create a new job instance.
     *
     * @param  \Laravelish\Discuss\Comments\Comment  $comment
     * @param  array $input
     * @return void
     */
    public function __construct($comment, array $input)
    {
        $this->input   = $input;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @param  \Laravelish\Discuss\Author\Author $author
     * @param  \Laravelish\Discuss\Comments\Moderator $moderator
     * @return void
     */
    public function handle(Author $author, Moderator $moderator)
    {
        if ($author->isAdmin()) {
            unset($this->input['author_ip'], $this->input['user_agent']);

            if ($this->comment->user_id) {
                $this->input = Arr::only($this->input, ['status', 'content']);
            }

            foreach ($this->input as $key => $value) {
                $this->comment->{$key} = $value;
            }
        } else {
            $this->comment->content = $this->input['content'];

            $this->input['permalink']    = $this->comment->permalink;
            $this->input['author_url']   = $this->comment->author_url;
            $this->input['author_name']  = $this->comment->author_name;
            $this->input['author_email'] = $this->comment->author_email;

            $this->comment->status = $moderator->getStatus($this->input);
        }

        $this->fire(new CommentWillBeSaved($this->comment));

        $this->comment->save();

        $this->fire(new CommentWasUpdated($this->comment));
    }
}
