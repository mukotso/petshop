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
            $table->char('id', 36)->unique()->primary();
            $table->char('user_uuid',36);
            $table->char('order_status_uuid',36);
            $table->char('payment_uuid',36);
            $table->json('products', 255);
            $table->json('address', 255);
            $table->decimal('delivery_fee', 8, 2)->default(0);
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
