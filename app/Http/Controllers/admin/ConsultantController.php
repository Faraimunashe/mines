<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index()
    {
        $cons = Consultant::all();

        return view('admin.consultants', [
            'consultants' => $cons
        ]);
    }
}
