
<h1 id="events">Events</h1>
<hr>

<p>To listen for an event, first you need to <a href="http://laravel.com/docs/5.1/events#defining-listeners">define a listener</a>, then <a href="http://laravel.com/docs/5.1/events#registering-events-and-listeners">register</a> it in the <code>EventServiceProvider</code>.</p>
<h4 id="example">Example</h4>
<p><strong>app/Providers/EventServiceProvider.php</strong></p>
<pre><code class="php">protected $listen = [
    'Deejavu\Comments\Events\CommentWasPosted' =&gt; [
        'App\Listeners\SendEmailNotification',
    ],
];
</code></pre>

<p><strong>app/Listeners/SendEmailNotification.php</strong></p>
<pre><code class="php">&lt;?php

namespace App\Listeners;

use Deejavu\Comments\Comments\Comment;
use Deejavu\Comments\Events\CommentWasPosted;

class SendEmailNotification
{
    /**
    * Create the event listener.
    *
    * @return void
    */
   public function __construct()
   {
       //
   }

   /**
    * Handle the event.
    *
    * @param  CommentWasPosted $event
    * @return void
    */
   public function handle(CommentWasPosted $event)
   {
       // Access the comment using $event-&gt;comment...
   }
}
</code></pre>

<p>You can find all of Ajax Comment System events in the <code>src/Events</code> folder.</p>
