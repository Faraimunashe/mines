<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }
}
