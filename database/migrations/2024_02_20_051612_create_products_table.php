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
            $table->unsignedBigInteger('product_category_id')->unique;
            $table->foreign('product_category_id')->references('id')->on('product_categories')->ondelete('cascade')->onupdate('cascade');
            $table->string('product_name', 100)->unique;
            $table->text('description');
            $table->double('price');
            $table->integer('stok_quantity');
            $table->string('image1_url');
            $table->string('image2_url');
            $table->string('image3_url');
            $table->string('image4_url');
            $table->string('image5_url');
            $table->string('slug')->unique();
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
