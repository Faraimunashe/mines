<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index()
    {
        $cons = Consult::all();

        return view('client.consultants', [
            'consultants' => $cons
        ]);
    }
}
