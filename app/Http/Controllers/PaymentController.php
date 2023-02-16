<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Routing\Controller;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Midtrans\Transaction;


class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('app.midtrans_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 10000,
        );
        $customer_details = array(
            'name' => 'Asa',
            'email' => 'budi.pra@example.com',
            'phone' => '08111222333',
        );
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details
        );


        $payment = new Payment;
        $payment->order_id = $transaction_details['order_id'];
        $payment->name = $customer_details['name'];
        $payment->amount = $transaction_details['gross_amount'];
        $payment->status = 'pending';
        $payment->save();

        $snapToken = Snap::getSnapToken($params);

        return view('payment', ['snapToken' => $snapToken]);
    }
    public function AfterPayment(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $transaction = Transaction::status($request->transaction_id);
        if ($transaction->transaction_status == 'capture') {
            $payment = Payment::find($request->order_id);
            $payment->update(['status' => 'paid']);
        }
        ;
        return response()->json('lunas, udah bayar');
    }
}