<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**.
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jwt_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('unique_id');
            $table->unsignedBigInterger('user_id');
            $table->string('token_title',255);
            $table->json('restrictions',255);
            $table->json('permissions',255);
            $table->timestamp('expires_at');
            $table->timestamp('last_used_at');
            $table->timestamp('refreshed_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jwt_tokens');
    }
};
