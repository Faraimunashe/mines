<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\MineralSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = MineralSale::where('buyer_id', client()->id)->get();

        return view('client.purchases', [
            'purchases'=>$purchases
        ]);
    }
}
