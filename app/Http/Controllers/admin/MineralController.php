<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mineral;
use Illuminate\Http\Request;

class MineralController extends Controller
{
    public function index()
    {
        $mins = Mineral::where('active', true)->get();

        return view('admin.minerals', [
            'minerals' =>$mins
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'mineral_id' => 'required|numeric',
            'level' => 'required|numeric'
        ]);

        $min = Mineral::find($request->mineral_id);
        if(is_null($min)){
            return redirect()->back()->with('error', 'could not find specified record');
        }

        $min->level = $request->level;
        $min->save();

        return redirect()->back()->with('success', 'successfully updated mineral accessibility');
    }
}
