<?php

namespace App\Http\Controllers;

use App\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $files = File::all();
        return view('projects.files.index', [
            'files' => $files
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('projects.files.show');
    }
}
