<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    public function index()
    {
        $cons = Consult::all();

        return view('admin.consults', [
            'consults' =>$cons
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'consult_id' => 'required|numeric',
            'level' => 'required|numeric'
        ]);

        $con = Consult::find($request->consult_id);
        if(is_null($con)){
            return redirect()->back()->with('error', 'could not find specified record');
        }

        $con->level = $request->level;
        $con->save();

        return redirect()->back()->with('success', 'successfully updated consult accessibility');
    }
}
