<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DummySignature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cafs:signature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sha_string = '';
        $req_array = [
            'service_command' => 'PAYMENT_LINK',
            'access_code'        => 'Hd2JRXbMCWp1yrjLPfSw',
            'merchant_identifier' => 'a47fe142',
            'merchant_reference' => 'Test-962356101',
            'amount'             => '10000',
            'currency'           => 'SAR',
            'language'           => 'en',
            'customer_email'     => 'baloot.mhl@gmail.com',
            'request_expiry_date' => '2024-02-10T08:15:09+00:00',
            'payment_link_id' => '169996200013942416',
            'notification_type' => 'EMAIL'
        ];
        ksort($req_array);
        foreach ($req_array as $key => $value) {
            $sha_string .= "$key=$value";
        }

        $sha_string = '79S7hUA5shSJEUEO1CW1Rf?&' . $sha_string . '79S7hUA5shSJEUEO1CW1Rf?&';
        $signature = hash("sha256", $sha_string);

        $this->info('Signature: '.$signature);
    }
}
