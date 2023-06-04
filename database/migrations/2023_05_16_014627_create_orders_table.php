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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->string('city_name');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('postal_code')->nullable();
            $table->text('order_note')->nullable();
            $table->string('payment_type');
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->float('amount',8,2);
            $table->string('order_number');
            $table->string('invoice_number');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->date('confimed_date')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('picked_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
