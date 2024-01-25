<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Integrations\AmazonPaymentServices\PaymentConnector;
use App\Http\Integrations\AmazonPaymentServices\Requests\CreateInvoiceRequest;
use App\Models\Event;
use App\Models\PaymentLink;
use Illuminate\Http\Request;

class PaymentLinkController extends Controller
{
    public function save(Request $request)
    {
        $payment_link = PaymentLink::findOrFail($request->payment_link_id);
        $event = Event::findOrFail($request->event_id);
        $aps = new PaymentConnector();
        $link_req = new CreateInvoiceRequest($payment_link->id, $event->id);
        $response = $aps->send($link_req);
        $json_res = $response->json();

        // dd($response);

        return responder()->success($json_res)->respond();
    }
}
