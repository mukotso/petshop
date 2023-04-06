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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInterger('category_id');
            $table->string('title', 255)->fulltext();
            $table->char('uuid', 36);
            $table->decimal('price', 12, 2);
            $table->text('description');
            $table->json('metadata');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
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
