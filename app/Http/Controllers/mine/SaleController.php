<?php

namespace App\Http\Controllers\mine;

use App\Http\Controllers\Controller;
use App\Models\MineralSale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = MineralSale::join('minerals', 'minerals.id', '=', 'mineral_sales.mineral_id')
            ->where('minerals.mine_id', mine()->id)
            ->select('mineral_sales.buyer_id', 'mineral_sales.mineral_id', 'mineral_sales.selling_amount', 'mineral_sales.mine_amount', 'mineral_sales.system_amount')
            ->get();

            //dd($sales);
        //$sales = MineralSale::all();

        return view('mine.sales', [
            'sales' => $sales
        ]);
    }
}
