<?php

namespace Laravelish\Discuss\Listeners;

use Laravelish\Discuss\Comments\Comment;
use Laravelish\Discuss\Events\CommentWasPosted;
use Laravelish\Discuss\Mailers\Mailer;

class SendCommentNotification
{
    /**
     * @var \Laravelish\Discuss\Mailers\Mailer
     */
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @param Laravelish\Discuss\Mailers\Mailer $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  \Laravelish\Discuss\Events\CommentWasPosted $event
     * @return void
     */
    public function handle(CommentWasPosted $event)
    {
        $comment = $event->comment;

        $adminEmail = config('comments.admin_email');

        if ($adminEmail && $adminEmail !== $comment->author_email && $comment->status !== Comment::SPAM) {
            $this->mailer->emailAdmin($adminEmail, $comment);
        }

        if (!config('comments.reply_email') || $comment->status !== Comment::APPROVED || !$comment->parent) {
            return;
        }

        $parentEmail = $comment->parent->author_email;

        if ($parentEmail === $adminEmail || $parentEmail === $comment->author_email) {
            return;
        }

        $this->mailer->emailUser($parentEmail, $comment);
    }
}
