<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->comment('1-5 stars');
            $table->text('review')->nullable();
            $table->json('images')->nullable()->comment('Review images paths');
            $table->boolean('is_verified')->default(true)->comment('Verified purchase');
            $table->boolean('is_recommended')->default(true);
            $table->timestamps();
            
            // Ensure one review per order item
            $table->unique(['order_item_id'], 'unique_review_per_order_item');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};