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
            $table->string('photo');
            $table->Integer('sales_count')->default('0');
            $table->Integer('rate');
            $table->Integer('price');
            $table->Integer('discount_percent')->default('0');
            $table->Integer('discount_value')->default('0');
            $table->Integer('final_value');
            $table->foreignId('category_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
