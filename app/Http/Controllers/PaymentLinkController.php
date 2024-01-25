<?php

namespace App\Http\Controllers;

use App\Http\Integrations\AmazonPaymentServices\PaymentConnector;
use App\Http\Integrations\AmazonPaymentServices\Requests\CreateInvoiceRequest;
use App\Models\Event;
use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentLinkController extends Controller
{
    public function index()
    {
        $links = PaymentLink::orderBy('created_at', 'DESC')->get();

        $title = 'Delete Payment Link!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('payment-links.index', compact('links'));
    }

    public function create()
    {
        $events = Event::all();

        return view('payment-links.create', compact('events'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $event = Event::findOrFail($data['event_id']);
        $payment_link = new PaymentLink();
        $payment_link->merchant_reference = $payment_link->generateMerchantReferenceNumber();
        $payment_link->amount = $data['amount'];
        $payment_link->currency = $data['currency'];
        $payment_link->customer_name = $data['customer_name'];
        $payment_link->customer_email = $data['customer_email'];
        $payment_link->request_expiry_date = now()->addDays(30);
        $payment_link->event_id = $data['event_id'];
        $payment_link->save();

        $aps = new PaymentConnector();
        $link_req = new CreateInvoiceRequest($payment_link->id, $event->id);
        $response = $aps->send($link_req);
        $json_res = $response->json();

        $payment_link->link = $json_res['payment_link'];
        $payment_link->invoice_number = $json_res['payment_link_id'];
        $payment_link->data = $json_res;
        $payment_link->save();

        Alert::success('Success', 'Payment Link created.');

        return redirect()->route('payment-links.index');
    }

    public function show($id)
    {
        $link = PaymentLink::findOrFail($id);

        return view('payment-links.show', compact('link'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $payment_link = PaymentLink::findOrFail($id);
        $payment_link->amount = $data['amount'];
        $payment_link->currency = $data['currency'];
        $payment_link->customer_name = $data['customer_name'];
        $payment_link->customer_email = $data['customer_email'];
        $payment_link->request_expiry_date = $data['request_expiry_date'];
        $payment_link->link = "https://sbcheckout.payfort.com/5cc935253d0b217b";
        $payment_link->save();

        Alert::success('Success', 'Payment Link updated.');

        return redirect()->route('payment-links.index');
    }

    public function destroy($id)
    {
        $payment_link = PaymentLink::findOrFail($id);
        $payment_link->delete();

        Alert::success('Success', 'Payment Link deleted.');

        return redirect()->route('payment-links.index');

    }
}
