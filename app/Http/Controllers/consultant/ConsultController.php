<?php

namespace App\Http\Controllers\consultant;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    public function index()
    {
        $consults = Consult::where('consultant_id', consultant()->id)->get();
        return view('consultant.consults', [
            'consults' => $consults
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'topic' => ['required', 'string'],
            'fee' => ['required', 'numeric'],
            'description' => ['required', 'string']
        ]);


        $con = new Consult();
        $con->consultant_id = consultant()->id;
        $con->topic = $request->topic;
        $con->fee = $request->fee;
        $con->description = $request->description;
        $con->level = 1;
        $con->save();

        return redirect()->back()->with('success', 'successfully added a consult to catalogue');
    }

    public function delete($id)
    {
        $con = Consult::find($id);
        if(is_null($con)){
            return redirect()->back()->with('error', 'could not locate this consult');
        }

        $con->delete();

        return redirect()->back()->with('success', 'successfully deleted consult');
    }
}
