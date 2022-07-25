<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mine;
use Illuminate\Http\Request;

class MineController extends Controller
{
    public function index()
    {
        $mines = Mine::all();

        return view('admin.mines', [
            'mines' => $mines
        ]);
    }
}
