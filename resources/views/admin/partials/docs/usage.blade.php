<h1 id="usage">Usage</h1>
<hr>
<h3 id="the-get-author-method">The Get Author Method</h3>
<p>In your <code>User</code> class/model you must add the <code>getAuthor</code> method that has to return some user attributes: </p>
<pre><code class="php">class User extends Model implements ...
    {
        /**
         * Return the user attributes.
         * @return array
         */
        public function getAuthor()
        {
            return [
                'id'     =&gt; $this-&gt;id,
                'name'   =&gt; $this-&gt;name,
                'email'  =&gt; $this-&gt;email,
                'url'    =&gt; $this-&gt;url,  // Optional
                'avatar' =&gt; 'gravatar',
                'admin'  =&gt; $this-&gt;role === 'admin', // bool
            ];
        }
    }
</code></pre>
<p>By default the avatar is set to Gravatar, but you can return an image.</p>
<p>The <code>admin</code> attribute makes use of the <code>role</code> field, added to the users table in the <a href="#installation.md">installation</a> part. <br> If you have another way of detecting if the user is admin, then the <code>admin</code> attribute must a boolean value.</p>
<h3 id="include-the-css-files">Include The CSS Files</h3>
<pre><code class="markup">&lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css&quot;&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;/vendor/comments/css/prism-okaidia.css&quot;&gt; &lt;!-- Optional --&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;/vendor/comments/css/comments.css&quot;&gt;
</code></pre>
<blockquote>
    <p>Note: </p>
    <h4 id="no-bootstrap">No Bootstrap!</h4>
    <p>If you don't use Bootstrap, include <code>/vendor/comments/css/bootstrapless.css</code> instead of <code>bootstrap.min.css</code>.<br>
    By doing so, the Bootstrap CSS will be isolated to the comments and won't conflict with your CSS.</p>
</blockquote>
<style>.callout-info p:first-child { display: none; }</style>
<h3 id="include-the-javascript-files">Include The JavaScript Files</h3>
<pre><code class="markup">&lt;script src=&quot;http://code.jquery.com/jquery-2.1.4.min.js&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;/vendor/comments/js/prism.js&quot;&gt;&lt;/script&gt; &lt;!-- Optional --&gt;
    &lt;!-- This must be included before the closing &lt;/body&gt; tag! --&gt;
    &lt;script src=&quot;/vendor/comments/js/comments.js&quot;&gt;&lt;/script&gt;
</code></pre>
<p>If you have already included jQuery or Bootstrap JS you don't have to include them again. <br>
Even if your app doesn't use Bootstrap, the <code>bootstrap.min.js</code> file is still required.</p>
<blockquote>
    <p>Notice:
        Make sure you you have the <a href="http://laravel.com/docs/5.1/authentication">Laravel Authentication</a> driver configured.</p>
    </blockquote>
    <h3 id="display-the-comments">Display The Comments</h3>
    <pre><code class="php">include('comments::display', ['pageId' => 'page1'])
    </code></pre>
    <p>The <code>pageId</code> parameter should be set to an unique identifier (int/string) for each page. </p>
    <h3 id="access-the-admin-panel">Access The Admin Panel</h3>
    <p>You can access the Admin Panel at <code>/comments/admin</code>, but make sure the user that you're logged in with has the <code>role</code> field set to <code>admin</code> in the database.</p>
    <p>If you have something like <code>phpMyAdmin</code> just edit the role field or you can write a simple query to edit a user:</p>
    <pre><code class="php">$user = \App\User::find(1);
        $user-&gt;role = 'admin';
        $user-&gt;save();
    </code></pre>
