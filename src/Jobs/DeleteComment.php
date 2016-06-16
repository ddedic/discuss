<?php

namespace Laravelish\Discuss\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Laravelish\Discuss\Comments\Comment;
use Laravelish\Discuss\Events\CommentWasDeleted;
use Laravelish\Discuss\Events\CommentWillBeDeleted;

class DeleteComment extends Job implements SelfHandling
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Create a new job instance.
     *
     * @param  int $id
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = Comment::findOrFail($this->id);

        $this->fire(new CommentWillBeDeleted($comment));

        $comment->delete();

        $this->fire(new CommentWasDeleted($comment));
    }
}
