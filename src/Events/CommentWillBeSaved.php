<?php

namespace Laravelish\Discuss\Events;

use Laravelish\Discuss\Comments\Comment;

class CommentWillBeSaved
{
    /**
     * @var \Laravelish\Discuss\Comments\Comment
     */
    public $comment;

    /**
     * Create a new event instance.
     *
     * @param \Laravelish\Discuss\Comments\Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
