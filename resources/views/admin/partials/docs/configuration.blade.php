<h1 id="configuration">Configuration</h1>
<ul>
  <li><a href="#recaptcha">reCAPTCHA</a></li>
  <li><a href="#real-time">Real Time</a></li>
  <li><a href="#formatting">Formatting</a></li>
</ul>
<p>All of the configuration options for the Laravel Comments are stored in <code>config/comments.php</code>.
You may also change the options from the <strong>Settings</strong> page in the admin panel.</p>
<blockquote>
  <p>Notice: The options from the admin panel will always have priority over the one from the file.</p>
</blockquote>
<h2 id="recaptcha">reCAPTCHA</h2>
<p>Add <code>"marwelln/recaptcha" : "~2.0"</code> to your <code>composer.json</code> file and run <code>composer install</code>.</p>
<p>Add <code>'Marwelln\Recaptcha\RecaptchaServiceProvider'</code> to your <code>providers</code> array in <code>config/app.php</code>.</p>
<p>Run <code>php artisan vendor:publish --provider="Marwelln\Recaptcha\RecaptchaServiceProvider"</code>.</p>
<p>Get your recaptcha keys at <a href="https://www.google.com/recaptcha/admin">google.com/recaptcha/admin</a> and copy them in <code>config/recaptcha.php</code>.</p>
<p>Now you can enable the <code>captcha</code> option in <code>config/comments.php</code> or from the <strong>Settings</strong> page under the <strong>Protection</strong> tab.</p>
<h2 id="real-time">Real Time</h2>
<p>If you wish to enable real time comments, you need to have a <a href="http://laravel.com/docs/5.1/events#broadcasting-events">broadcast</a> driver configured (works with Pusher and Redis with Socket.IO).</p>
<p>When using the Redis driver, you must have Node server with <a href="http://socket.io">Socket.IO</a> running and add it to your <code>redis</code> connection in <code>config/broadcasting.php</code>.</p>
<pre><code class="php">'redis' =&gt; [
      'driver'     =&gt; 'redis',
      'connection' =&gt; 'default',
      'socket'     =&gt; 'http://localhost:3000', // &lt;=
  ],
</code></pre>
<p>To run the Node socket, download the <a href="https://github.com/hazzardweb/ajax-comment-system-laravel-demo/blob/master/socket.js">scoket.js</a> file and run <code>node socket.js</code>.</p>
<p>Learn more about <a href="https://laracasts.com/lessons/broadcasting-events-in-laravel-5-1">broadcasting events</a> in Laravel.</p>
<h2 id="formatting">Formatting</h2>
<p>The script uses the <a href="https://github.com/s9e/TextFormatter">TextFormatter</a> package and allows you to highly customize the comment formatter. <br> By default you have some options to choose from, but if you want to add even more options you can configure the formatter however you want using the <code>Deejavu\Comments\Events\FormatterConfigurator</code> <a href="events.md">event</a>:</p>
<p>First <a href="http://laravel.com/docs/5.1/events#defining-listeners">define a listener</a>, then <a href="http://laravel.com/docs/5.1/events#registering-events-and-listeners">register</a> it in the <code>EventServiceProvider</code>.</p>
<h4 id="example">Example</h4>
<p><strong>app/Providers/EventServiceProvider.php</strong></p>
<pre><code class="php">protected $listen = [
      'Deejavu\Comments\Events\FormatterConfigurator' =&gt; [
          'App\Listeners\ConfigureFormatter',
      ],
  ];
</code></pre>
<p><strong>app/Listeners/ConfigureFormatter.php</strong></p>
<pre><code class="php">&lt;?php
  namespace App\Listeners;
  use s9e\TextFormatter\Configurator;
  use Deejavu\Comments\Events\FormatterConfigurator;
  class ConfigureFormatter
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
      * @param  FormatterConfigurator $event
      * @return void
      */
     public function handle(FormatterConfigurator $event)
     {
         // Access the configurator using $event-&gt;configurator...
         $event-&gt;configurator-&gt;Emoticons-&gt;add(':)', '&amp;#x1f604;');
     }
  }
</code></pre>
<p>Learn more about the <a href="http://s9etextformatter.readthedocs.org/">TextFormatter</a>.</p>
<blockquote>
  <p>Notice: Each time you change something related to the formatter, you must run <code>php artisan cache:clear</code> to clear the formatter configuration cache. </p>
</blockquote>
