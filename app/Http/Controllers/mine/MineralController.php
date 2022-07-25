<?php

namespace App\Http\Controllers\mine;

use App\Http\Controllers\Controller;
use App\Models\Mine;
use App\Models\Mineral;
use App\Models\MineralBid;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MineralController extends Controller
{
    public function index()
    {
        $minerals = Mineral::where('mine_id', mine()->id)->where('active', true)->get();
        //dd(mine()->id);
        return view('mine.minerals', [
            'minerals' => $minerals
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'string']
        ]);

        $mine = Mine::where('user_id', Auth::id())->first();
        if (is_null($mine)){
            return redirect()->route('mine-details')->with('error', 'register mine details first!');
        }

        $mineral = new Mineral();
        $mineral->mine_id = $mine->id;
        $mineral->name = $request->name;
        $mineral->price = $request->price;
        $mineral->quantity = $request->quantity;
        $mineral->level = 1;
        $mineral->save();

        return redirect()->back()->with('success', 'successfully added a mineral to catalogue');
    }

    public function delete($id)
    {
        $mineral = Mineral::find($id);
        if(is_null($mineral)){
            return redirect()->back()->with('error', 'mineral could not be found!');
        }


        MineralBid::where('mineral_id', $mineral->id)->delete();

        $mineral->delete();
        return redirect()->back()->with('success', 'successfully deleted mineral.');
    }

    public function bids()
    {
        $minerals = Mineral::where('mine_id', mine()->id)->where('active', true)->get();
        return view('mine.bids', [
            'minerals' => $minerals
        ]);
    }

    public function chose_bid($id)
    {
        $bid = MineralBid::find($id);
        if(is_null($bid)){
            return redirect()->back()->with('error', 'Bid could not be found');
        }

        $bid->status = "won";
        $bid->save();
        try{
            $mineral = Mineral::where('mine_id', mine()->id)->first();
            MineralBid::where('mineral_id', $mineral->id)
            ->where('status', 'pending')
            ->update(['status' => 'lost']);
        }catch(QueryException $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'successfully selected bid');
    }
}
