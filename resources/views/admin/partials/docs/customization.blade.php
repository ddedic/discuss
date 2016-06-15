
<h1 id="customization">Customization</h1>
<ul>
<li><a href="#assets">Assets</a></li>
<li><a href="#views">Views</a></li>
<li><a href="#translations">Translations</a></li>
<li><a href="#not-found-exceptions">Not Found Exceptions</a></li>
</ul>
<h2 id="assets">Assets</h2>
<p>If you wish to edit something in the JavaScript (or less) files, you have to compile them with <a href="http://laravel.com/docs/5.1/elixir">Laravel Elixir</a>.</p>
<p>From your terminal/console cd into the <code>comments</code> directory and <a href="http://laravel.com/docs/5.1/elixir#installation">install</a> Laravel Elixir there.  </p>
<p>Now you can edit the JavaScript files and <a href="http://laravel.com/docs/5.1/elixir#running-elixir">run Elixir</a> with <code>gulp</code> or <code>gulp watch</code>.</p>
<p>Each time you compile the assets you have to run <code>php artisan vendor:publish --tag="public" --force</code> to override the compiled assets (or change the <code>jsDest</code> and <code>cssDest</code> variables in the <code>gulpfile.js</code> file).</p>
<h2 id="views">Views</h2>
<p>If you wish to customize the views copy the view files from <code>comments/resources/views</code> to <code>resources/vendor/comments</code> and edit there.</p>
<h2 id="translations">Translations</h2>
<p>See <a href="http://laravel.com/docs/5.1/localization#overriding-vendor-language-files">Overriding Vendor Language Files</a>.</p>
<h2 id="not-found-exceptions">Not Found Exceptions</h2>
<p>To catch <code>ModelNotFoundException</code> exceptions edit <code>app/Exceptions/Handler.php</code> and add in the <code>render</code> method:</p>
<pre><code class="php">public function render($request, Exception $e)
{
    if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException &amp;&amp; $request-&gt;ajax()) {
        return response()-&gt;json('Not found.', 404);
    }

    return parent::render($request, $e);
}
</code></pre>
