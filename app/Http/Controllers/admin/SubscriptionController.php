<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();

        return view('admin.subscriptions', [
            'subscriptions' =>$subs
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $sub = Subscription::find($request->subscription_id);
        if(is_null($sub)){
            return redirect()->back()->with('error', 'could not find specified record');
        }

        $sub->amount = $request->amount;
        $sub->save();

        return redirect()->back()->with('success', 'successfully updated subscription amount');
    }
}
