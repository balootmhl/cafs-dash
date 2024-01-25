<?php

namespace App\Http\Integrations\AmazonPaymentServices;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;


class PaymentConnector extends Connector implements HasBody
{
    use AcceptsJson;
    use HasJsonBody;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return config('services.amazon.url');
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    protected function defaultBody(): array
    {
        return [

        ];
    }


    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
