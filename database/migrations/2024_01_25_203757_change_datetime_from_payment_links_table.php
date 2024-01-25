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
        Schema::table('payment_links', function (Blueprint $table) {
            $table->dropColumn('request_expiry_date');
        });
        Schema::table('payment_links', function (Blueprint $table) {
            $table->datetime('request_expiry_date')->after('customer_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_links', function (Blueprint $table) {
            $table->dropColumn('request_expiry_date');
        });
        Schema::table('payment_links', function (Blueprint $table) {
            $table->date('request_expiry_date')->after('customer_email')->nullable();
        });
    }
};
