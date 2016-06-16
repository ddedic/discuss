<?php

namespace Laravelish\Discuss\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Laravelish\Discuss\Http\Middleware\Admin;

class DocsController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

        $this->middleware(Admin::class);
    }

    public function index()
    {

        return view('comments::admin.docs');
    }
}
