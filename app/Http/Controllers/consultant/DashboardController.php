<?php

namespace App\Http\Controllers\consultant;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(is_null(consultant())){
            return redirect()->route('consultant-details')->with('error', 'Please enter mine details here and proceed!');
        }
        return view('consultant.dashboard');
    }

    public function details()
    {
        return view('consultant.details');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'digits:10']
        ]);

        $con = new Consultant();
        $con->user_id = Auth::id();
        $con->name = $request->name;
        $con->address = $request->address;
        $con->phone = $request->phone;
        $con->save();

        return redirect()->route('consultant-dashboard')->with('success', 'successfully added profile details');
    }
}
