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
            $table->string('order_no',10);
            $table->foreignId('customer_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->datetime('order_date');
            $table->integer('subtotal');
            $table->integer('discount_id')->nullable();
            $table->integer('discount')->nullable();
            $table->bigInteger('total_amount');
            $table->enum('payment_method',['cod','transfer'])->default('cod');
            $table->enum('bank_name', ['BRI','BCA','BSI','Mandiri'])->nullable();
            $table->integer('card_number')->nullable();
            $table->enum('payment_status',['paid','not_paid'])->default('not_paid');
            $table->enum('status', ['pending', 'shipped', 'delivered','cancelled'])->default('pending');
            $table->datetime('delivered_date')->nullable();
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
