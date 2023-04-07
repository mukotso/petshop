<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36)->primary();
            $table->unsignedBigInterger('user_uuid');
            $table->unsignedBigInterger('order_status_uuid');
            $table->unsignedBigInterger('payment_uuid');
            $table->json('products', 255);
            $table->json('address', 255);
            $table->decimal('delivery_fee', 8, 2)->nullable();
            $table->decimal('amount', 12, 2);
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();

            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->foreign('order_status_uuid')->references('uuid')->on('order_statuses');
            $table->foreign('payment_uuid')->references('uuid')->on('payments');
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
