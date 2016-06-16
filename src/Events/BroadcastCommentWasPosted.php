<?php

namespace Laravelish\Discuss\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastCommentWasPosted extends CommentWasPosted implements ShouldBroadcast
{
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['comment.' . $this->comment->page_id];
    }
}
