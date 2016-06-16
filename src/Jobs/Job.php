<?php

namespace Laravelish\Discuss\Jobs;

abstract class Job
{
    /**
     * Fire an event.
     *
     * @param  mixed $event
     * @return void
     */
    public function fire($event)
    {
        event($event);
    }
}
