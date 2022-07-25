<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(is_null(client())){
            return redirect()->route('client-details')->with('error', 'Please enter client details here and proceed!');
        }
        $subs = Subscription::all();
        return view('client.dashboard', [
            'subs' => $subs
        ]);
    }

    public function details()
    {
        return view('client.details');
    }

    public function add(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'phone' => ['required', 'digits:10']
        ]);

        $client = new Client();
        $client->user_id = Auth::id();
        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->phone = $request->phone;
        $client->level = 0;

        $client->save();

        return redirect()->route('client-dashboard')->with('success', 'successfully added profile details');
    }
}
