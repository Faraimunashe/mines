<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MineralSale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = MineralSale::all();

        return view('admin.sales', [
            'sales' => $sales
        ]);
    }
}
