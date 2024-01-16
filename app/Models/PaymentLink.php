<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentLink extends Model
{
    use HasFactory;

    function generateMerchantReferenceNumber($length = 15)
    {
        // Ensure an odd length for better placement of the hyphen/dash/dot
        if ($length % 2 === 0) {
            $length--;
        }

        // Generate the first half of the string
        $firstHalf = Str::random(($length - 1) / 2);

        // Generate the second half of the string
        $secondHalf = Str::random(($length - 1) / 2);

        // Concatenate the two halves with the separator in the middle
        $referenceNumber = $firstHalf . '-' . $secondHalf;

        return $referenceNumber;
    }
}
