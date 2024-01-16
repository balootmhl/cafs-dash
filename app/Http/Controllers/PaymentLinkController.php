<?php

namespace App\Http\Controllers;

use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PaymentLinkController extends Controller
{
    public function index()
    {
        $links = PaymentLink::orderBy('created_at', 'DESC')->get();

        return view('payment-links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $payment_link = new PaymentLink();
        $payment_link->merchant_reference = $payment_link->generateMerchantReferenceNumber();
        $payment_link->amount = $data['amount'];
        $payment_link->currency = $data['currency'];
        $payment_link->customer_name = $data['customer_name'];
        $payment_link->customer_email = $data['customer_email'];
        $payment_link->request_expiry_date = $data['request_expiry_date'];
        $payment_link->link = "https://sbcheckout.payfort.com/5cc935253d0b217b";
        $payment_link->save();

        return redirect()->route('payment-links.index')->with('success', 'Payment Link updated.');
    }


}