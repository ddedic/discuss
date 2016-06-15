<h1 id="installation">Installation</h1>
<ul>
    <li><a href="#prerequisites">Prerequisites</a></li>
    <li><a href="#install-ajax-comment-system">Install Ajax Comment System</a></li>
    <li><a href="#requirements-and-browser-support">Requirements and Browser Support</a></li>
</ul>
<h2 id="prerequisites">Prerequisites</h2>
<p>This guide assumes that you already know how to <a href="http://laravel.com/docs/5.1/installation">install</a> and configure Laravel.</p>
<h2 id="install-ajax-comment-system">Install Ajax Comment System</h2>
<ol>
    <li>In your <code>app</code> directory, create a <code>comments</code> folder and extract all the files from the archive you have downloaded from CodeCanyon.</li>
    <li>Edit your <code>composer.json</code> file and add the following line to the <code>psr-4</code> autoload:</li>
</ol>
<pre><code class="php">&quot;Deejavu\\Comments\\&quot;: &quot;app/comments/src/&quot;
</code></pre>
<p>And this one to your dependencies (<code>require</code>): </p>
<pre><code class="php">&quot;s9e/text-formatter&quot;: &quot;^0.2.1&quot;
</code></pre>
<p>In your terminal/console run <code>composer install</code>.
    3. Add <code>'Deejavu\Comments\CommentsServiceProvider'</code> to your <code>providers</code> array in <code>config/app.php</code> and run:
</p>
<pre><code class="php">php artisan vendor:publish --provider=&quot;Deejavu\Comments\CommentsServiceProvider&quot;
</code></pre>
<p>This command will publish the configuration file (config/comments.php), the assets folder (public/vendor/comments) and the database migrations <strong>*</strong>.<br></p>
<blockquote>
    <p>Notice: The script assumes that you have already have the users table installed.
        5. Finally, run:
    </p>
</blockquote>
<pre><code class="php">php artisan migrate
</code></pre>
<ol>
    <li>Head over to the <a href="#usage" data-toggle="tab">Usage</a> section to get started. </li>
</ol>
<p><br>
    <strong>*</strong> The migrations will add 3 tables <code>comments</code>, <code>comment_votes</code>, <code>comment_options</code> and a <code>role</code> field to your users table. This field will be used to determine if the the authenticated user is an admin or a regular user. <br>
</p>
<blockquote>
    <p>Notice: If your app already has another method to determine that, then delete the <code>..._add_users_role_column.php</code> migration from the database/migrations directory.</p>
</blockquote>

<h3 id="requirements-and-browser-support">Requirements and Browser Support</h3>
<p>Laravel Comments requires Laravel 5.1.9 and supports the following browsers (desktop and mobile): Chrome, Firefox, Opera, Safari MS Edge and IE9+.</p>
<style>.docs-content ol { padding-left: 20px; }</style>
