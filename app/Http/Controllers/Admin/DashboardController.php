<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class DashboardController extends AdminController
{
    //
    public function index()
    {
        return Sentinel::getUser();
    }
}
