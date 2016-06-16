<?php

namespace Laravelish\Discuss\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravelish\Discuss\Author\Author;

class Admin
{
    /**
     * @var \Laravelish\Discuss\Author\Author $author
     */
    protected $author;

    /**
     * @param \Laravelish\Discuss\Author\Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->author->isAdmin()) {
            if ($request->ajax()) {
                return response()->json('Unauthorized.', 401);
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
