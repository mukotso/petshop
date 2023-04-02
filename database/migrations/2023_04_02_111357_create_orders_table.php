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
            $table->bigIncrements('id');
            $table->unsignedBigInterger('user_id');
            $table->unsignedBigInterger('order_status_id');
            $table->unsignedBigInterger('payment_id');
            $table->char('uuid',36);
            $table->json('products',255);
            $table->json('address',255);
            $table->decimal('delivery_fee',8,2);
            $table->decimal('amount',12,2);
            $table->timestamp('shipped_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('payment_id')->references('id')->on('payments');
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
