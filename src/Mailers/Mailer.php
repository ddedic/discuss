<?php

namespace Laravelish\Discuss\Mailers;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Laravelish\Discuss\Comments\Comment;

class Mailer
{
    /**
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create a new mailer instance.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function __construct(MailerContract $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send email to the admin.
     *
     * @param  string $email
     * @param  \Laravelish\Discuss\Comments\Comment $comment
     * @return void
     */
    public function emailAdmin($email, Comment $comment)
    {
        $this->send('comments::emails.notification', $email, $comment);
    }

    /**
     * Send comment reply email to a user.
     *
     * @param  string $email
     * @param  \Laravelish\Discuss\Comments\Comment $comment
     * @return void
     */
    public function emailUser($email, Comment $comment)
    {
        $this->send('comments::emails.reply', $email, $comment);
    }

    /**
     * Send email.
     *
     * @param  string  $view
     * @param  string  $email
     * @param  \Laravelish\Discuss\Comments\Comment $comment
     * @return void
     */
    public function send($view, $email, Comment $comment)
    {
        $this->mailer->queue($view, $this->getData($comment), function ($m) use ($email) {
            $m->to($email);
        });
    }

    /**
     * Get data to pass to the view.
     *
     * @param  \Laravelish\Discuss\Comments\Comment $comment
     * @return array
     */
    protected function getData(Comment $comment)
    {
        return [
            'status'      => $comment->status,
            'authorIp'    => $comment->author_ip,
            'authorName'  => $comment->author_name,
            'authorEmail' => $comment->author_email,
            'createdAt'   => $comment->created_at->toDateTimeString(),
            'permalink'   => $comment->permalink,
            'editLink'    => $comment->editLink,
            'content'     => $comment->content,
        ];
    }
}
