<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_links', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_reference');
            $table->double('amount');
            $table->string('customer_email');
            $table->date('request_expiry_date');
            $table->string('currency')->default('SAR');
            $table->string('language')->default('en');
            $table->string('customer_name')->nullable();
            $table->text('order_description')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('payment_option')->nullable();
            $table->string('notification_type')->default('EMAIL');
            $table->string('link')->nullable();
            $table->string('invoice_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
