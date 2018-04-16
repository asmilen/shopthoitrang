<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //
    public function index()
    {
        return view('dashboard');
    }
}
