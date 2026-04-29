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
        Schema::create('cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('article_id');
            $table->integer('article_number')->default(1);

            // Add foreign keys if possible, but let's keep it simple for now to avoid migration order issues
            // $table->foreign('autor_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('article_id')->references('article_id')->on('article')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
