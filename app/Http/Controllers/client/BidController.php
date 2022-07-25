<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Mineral;
use App\Models\MineralBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function index()
    {
        $minerals = Mineral::where('active', true)->get();
        $won = MineralBid::where('status', 'won')->where('user_id', Auth::id())->get();

        return view('client.bidding', [
            'minerals' => $minerals,
            'won' => $won
        ]);
    }

    public function bid(Request $request)
    {
        $request->validate([
            'mineral_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);
        $already = MineralBid::where('mineral_id', $request->mineral_id)
            ->where('user_id', Auth::id())->first();
        if(is_null($already)){
            $bid = new MineralBid();
            $bid->mineral_id = $request->mineral_id;
            $bid->user_id = Auth::id();
            $bid->amount = $request->amount;

            $bid->save();

            return redirect()->back()->with('success', 'successfully placed a bid');

        }else{
            $already->amount = $request->amount;

            $already->save();

            return redirect()->back()->with('success', 'successfully updated your bid');
        }
    }
}
