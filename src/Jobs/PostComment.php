<?php

namespace Laravelish\Discuss\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Laravelish\Discuss\Author\Author;
use Laravelish\Discuss\Comments\Comment;
use Laravelish\Discuss\Comments\Moderator;
use Laravelish\Discuss\Events\CommentWasPosted;
use Laravelish\Discuss\Events\CommentWillBeSaved;

class PostComment extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $input;

    /**
     * Create a new job instance.
     *
     * @param  array $input
     * @return void
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @param  \Laravelish\Discuss\Author\Author $author
     * @param  \Laravelish\Discuss\Comments\Moderator $moderator
     * @return \Laravelish\Discuss\Comments\Comment
     */
    public function handle(Author $author, Moderator $moderator)
    {
        $input = $this->input;

        if (!$author->guest()) {
            $input = array_merge($input, [
                'user_id'      => $author->id(),
                'author_name'  => $author->name(),
                'author_email' => $author->email(),
                'author_url'   => $author->url(),
            ]);
        }

        if (!$author->isAdmin()) {
            $input['status'] = $moderator->getStatus($input);
        }

        if (!$author->guest()) {
            unset($input['author_email'], $input['author_name'], $input['author_url']);
        }

        $comment = new Comment($input);

        $this->fire(new CommentWillBeSaved($comment));

        $comment->save();

        $comment = Comment::find($comment->id);

        $this->fire(new CommentWasPosted($comment));

        return $comment;
    }
}
