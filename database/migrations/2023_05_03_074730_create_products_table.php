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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //forign keys
            $table->integer('vendor_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            //fields
            $table->string('product_name');
            $table->string('product_thumbnail');
            $table->text('short_desc');
            $table->text('long_desc');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('tags')->nullable();
            $table->string('product_color');
            $table->string('product_size');
            $table->double('selling_price');
            $table->double('discount_price')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
