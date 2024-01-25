<?php

namespace App\Http\Integrations\AmazonPaymentServices\Requests;

use App\Models\Event;
use App\Models\PaymentLink;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected int $payment_link_id,
        protected int $event_id
    ) {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/FortAPI/paymentApi';
    }

    protected function defaultBody(): array
    {
        $payment_link = PaymentLink::findOrFail($this->payment_link_id);
        $event = Event::findOrFail($this->event_id);
        $sha = '';
        $request = [
            'service_command' => 'PAYMENT_LINK',
            'access_code' => config('services.amazon.accesscode'),
            'merchant_identifier' => config('services.amazon.id'),
            'merchant_reference' => $payment_link->merchant_reference,
            'amount' => $payment_link->amount,
            'customer_email' => $payment_link->customer_email,
            'language' => 'en',
            'currency' => 'SAR',
            'notification_type' => 'EMAIL'
        ];
        foreach ($request as $key => $value) {
            $sha .= "$key=$value";
        }
        $sha_string = config('services.amazon.sharequest') . $sha . config('services.amazon.sharequest');
        $signature = hash("sha256", $sha_string);
        $request['signature'] = $signature;

        return $request;
    }


}
