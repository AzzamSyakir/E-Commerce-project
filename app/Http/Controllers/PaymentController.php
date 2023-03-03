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

    public function home()
    {
        return view('home');
    }
    
    public function checkout(Request $request)
    {
        $request->request->add(['total_price' => $request->qty * 1000]);
        $payment = Payment::create($request->all());
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment->id,
                'gross_amount' => $payment->total_price,
            ),
            'customer_details' => array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        return view('checkout', compact('snapToken', 'payment'));
    }
    public function CallBack(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $payment = Payment::find($request->order_id);
                $payment->update(['status' => 'paid']);
            }
        }
    }
    public function invoice($id)
    {
        $payment = Payment::find($id);
        return view('invoice', compact('payment'));
    }

}