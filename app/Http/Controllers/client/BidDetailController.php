<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Mineral;
use App\Models\MineralBid;
use App\Models\MineralSale;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidDetailController extends Controller
{
    public function index($id)
    {
        $bid = MineralBid::find($id);
        if(is_null($bid)){
            return redirect()->back()->with('error', 'could not find specified bid!');
        }
        $mineral = Mineral::find($bid->mineral_id);

        return view('client.bid-details', [
            'bid' => $bid,
            'mineral' => $mineral
        ]);
    }

    public function payment(Request $request)
    {
        $request->validate([
            'mineral_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        //$company = Company::where('user_id', Auth::id())->first();

        $wallet = "ecocash";

        //get all data ready
        $email = $request->email;
        $phone = $request->phone;
        $amount = $request->amount;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('client-bid-payment'),
            route('client-bid-payment'),
        );

        // Create Payments
        $invoice_name = "mineral_purchase_" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Mineral Purchase", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "mineral purchase";
                    $trans->amount = $info['amount'];
                    $trans->status = "successful";

                    $trans->save();

                    $sale = new MineralSale();
                    $sale->buyer_id = client()->id;
                    $sale->mineral_id = $request->mineral_id;
                    $sale->selling_amount = $info['amount'];
                    $sale->mine_amount = mineral_shares($info['amount']);
                    $sale->system_amount = $info['amount']-mineral_shares($info['amount']);
                    $sale->save();

                    deleteBids($request->mineral_id);
                    $the = Mineral::where('id', $request->mineral_id)->first();
                    $the->active = false;
                    $the->save();

                    return redirect()->route('client-bidding')->with('success', 'you have successfully purchased the mineral!');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();


                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "mineral_purchase";
                    $trans->amount = $info['amount'];
                    $trans->status = $info['status'];
                    $trans->save();

                    return redirect()->back()->with('error', 'Please wait a moment and refresh page transaction still processing');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'We could not perform your request at the moment');

    }
}
