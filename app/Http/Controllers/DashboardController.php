<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.index');
    }
    public function kasir()
    {
        return view('admin.index');
    }
    public function owner()
    {
        return view('admin.index');
    }
}
