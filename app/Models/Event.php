<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function paymentLinks()
    {
        return $this->hasMany(PaymentLink::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
