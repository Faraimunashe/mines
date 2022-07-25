<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MineralShare;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'amount'=>['required', 'numeric']
        ]);

        if($request->amount > 100 | $request->amount < 0){
            return redirect()->back()->with('error', 'The percentage should not be less than 0 or greater than 100!');
        }

        $share = MineralShare::first();
        $share->amount = $request->amount;
        $share->save();

        return redirect()->back()->with('success', 'Profits successfully updated');
    }
}
