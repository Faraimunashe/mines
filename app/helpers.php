<?php

use App\Models\Client;
use App\Models\Consult;
use App\Models\Consultant;
use App\Models\Mine;
use App\Models\Mineral;
use App\Models\MineralBid;
use App\Models\MineralShare;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

function mine(){
    $mine = Mine::where('user_id', Auth::id())->first();
    return $mine;
}

function getMine($mine_id){
    $mine = Mine::where('id', $mine_id)->first();
    return $mine;
}

function consultant(){
    $con = Consultant::where('user_id', Auth::id())->first();
    return $con;
}

function get_consultant($id){
    $con = Consultant::find($id);
    return $con;
}

function client(){
    $client = Client::where('user_id', Auth::id())->first();
    return $client;
}

function client_level(){
    $client = Client::where('user_id', Auth::id())->first();
    return $client->level;
}

function item_level($level){
    if($level == 1){
        return "Premium";
    }elseif($level == 2){
        return "Platinum";
    }else{
        return "Ordinary";
    }
}

function subscribed($item_level){
    $user_level = client_level();
    if ($user_level < $item_level){
        return false;
    }else{
        return true;
    }
}

function max_bid($mineral_id){
    $max = MineralBid::where('mineral_id', $mineral_id)->max('amount');
    if(is_null($max)){
        return 0.00;
    }
    return $max;
}

function client_bid($mineral_id){
    $mybid = MineralBid::where('mineral_id', $mineral_id)
    ->where('user_id', Auth::id())
    ->first();

    if(is_null($mybid)){
        return 0.00;
    }
    return $mybid->amount;
}

function client_bid_status($mineral_id){
    $status = MineralBid::where('mineral_id', $mineral_id)
        ->where('user_id', Auth::id())->first();
    if(is_null($status)){
        return null;
    }
    return $status->status;
}

function client_won_bid($mineral_id){
    $bid = MineralBid::where('mineral_id', $mineral_id)
        ->where('user_id', Auth::id())
        ->where('status', 'won')
        ->first();
    if(is_null($bid)){
        return false;
    }else{
        return true;
    }
}

function the_bid($mineral_id){
    $bid = MineralBid::where('mineral_id', $mineral_id)
        ->where('user_id', Auth::id())
        ->where('status', 'won')
        ->first();

    return $bid;
}

function active_bid($mineral_id){
    $bid = MineralBid::where('mineral_id', $mineral_id)
        ->where('user_id', Auth::id())
        ->whereNot('status', 'pending')
        ->first();

    if(is_null($bid)){
        return true;
    }else{
        return false;
    }
}

function bids_selected($mineral_id){
    $bid = MineralBid::where('id', $mineral_id)
        ->whereNot('status', 'pending')
        ->first();

    if (is_null($bid)){
        return false;
    }else{
        return true;
    }
}

function deleteBids($mineral_id){
    MineralBid::where('mineral_id', $mineral_id)->delete();
}

function mineral_shares($amount){
    $share = MineralShare::first();
    if(is_null($share)){
        return 0;
    }else{
        return $amount*($share->amount/100);
    }
}

function buyer($id){
    $buyer = Client::find($id);
    if(is_null($buyer)){
        return null;
    }else{
        return $buyer;
    }
}

function seller($id){
    $buyer = Mineral::find($id);
    if(is_null($buyer)){
        return null;
    }else{
	$seller = Mine::find($buyer->mine_id);
	if(is_null($seller)){
		return null;
	}else{
		return $seller;
	}

    }
}

function sold($id){
    $mineral = Mineral::find($id);
    if(is_null($mineral)){
        return null;
    }else{
        return $mineral;
    }
}

function share(){
    $share = MineralShare::first();
    if(is_null($share)){
        return 0;
    }else{
        return $share->amount;
    }
}

function subs_level($amount){
    $subs = Subscription::where('amount', $amount)->first();
    if(is_null($subs)){
        dd("error on subscription");
    }
    if( $subs->type == "PREMIUM"){
        return 1;
    }elseif($subs->type == "PLATINUM"){
        return 2;
    }
}
