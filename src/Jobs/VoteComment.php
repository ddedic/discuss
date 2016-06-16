<?php

namespace Laravelish\Discuss\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Laravelish\Discuss\Author\Author;
use Laravelish\Discuss\Comments\Comment;
use Laravelish\Discuss\Comments\Vote;

class VoteComment extends Job implements SelfHandling
{
    /**
     * @var \Laravelish\Discuss\Comments\Comment
     */
    protected $comment;

    /**
     * @var string
     */
    protected $type;

    /**
     * Create a new job instance.
     *
     * @param  \Laravelish\Discuss\Comments\Comment  $comment
     * @param  string $type
     * @return void
     */
    public function __construct($comment, $type)
    {
        $this->type    = $type;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @param  \Laravelish\Discuss\Author\Author $author
     * @return void
     */
    public function handle(Author $author)
    {
        $comment = $this->comment;

        if (!in_array($this->type, [Vote::UP, Vote::DOWN, Vote::REMOVE])) {
            return;
        }

        $vote = $comment->votes()->where('user_id', $author->id())->first();

        if ($vote) {
            if ($this->type === Vote::REMOVE) {
                $comment->decrement($vote->type === Vote::UP ? 'upvotes' : 'downvotes');
                $vote->delete();
            } elseif ($this->type !== $vote->type) {
                if ($this->type === Vote::UP) {
                    $comment->increment('upvotes');
                    $comment->decrement('downvotes');
                } elseif ($this->type === Vote::DOWN) {
                    $comment->decrement('upvotes');
                    $comment->increment('downvotes');
                }

                $vote->type = $this->type;

                $vote->save();
            }
        } else {
            $comment->votes()->save(new Vote([
                'user_id' => $author->id(),
                'type'    => $this->type,
            ]));

            $comment->increment($this->type === Vote::UP ? 'upvotes' : 'downvotes');
        }
    }
}
