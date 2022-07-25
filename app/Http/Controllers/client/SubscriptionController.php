<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientSubscription;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'phone'=>'required|digits:10|starts_with:07',
            'amount' => 'required|numeric',
            'email'=> 'required|email'
        ]);

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
        $invoice_name = "account_subscription_" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Account Subscription", $amount);

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

                    $subs = ClientSubscription::where('client_id', client()->id)->first();
                    if(is_null($subs)){
                        $subs = new ClientSubscription();
                        $subs->client_id = client()->id;
                        $subs->amount = $info['amount'];
                        $subs->save();
                    }else{
                        $subs->amount = $info['amount'];
                    }

                    $client = Client::find(client()->id);
                    $client->level = subs_level($info['amount']);
                    $client->save();

                    return redirect()->route('client-bidding')->with('success', 'you have successfully subscribed!');
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
