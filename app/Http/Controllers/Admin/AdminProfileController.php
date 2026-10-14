<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }
}