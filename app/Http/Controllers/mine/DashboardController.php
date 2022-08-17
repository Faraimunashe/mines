<?php

namespace App\Http\Controllers\mine;

use App\Http\Controllers\Controller;
use App\Models\Mine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(is_null(mine())){
            return redirect()->route('mine-details')->with('error', 'Please enter mine details here and proceed!');
        }
        return view('mine.dashboard');
    }

    public function details()
    {
        return view('mine.details');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'address' => ['required', 'string']
        ]);

        $mine = new Mine();
        $mine->user_id = Auth::id();
        $mine->name = $request->name;
        $mine->address = $request->address;
        $mine->save();

        return redirect()->route('mine-dashboard')->with('success', 'successfully added profile details');
    }
}
