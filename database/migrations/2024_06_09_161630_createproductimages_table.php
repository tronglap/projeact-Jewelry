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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 255)->unique();
            $table->timestamps();
        });

        Schema::table('product_images', function (Blueprint $table) {
            //B1
            $table->unsignedBigInteger('product_id');

            //B2
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            // Xóa ràng buộc khóa ngoại trước
            $table->dropForeign(['product_id']);
            // Xóa cột khóa ngoại
            $table->dropColumn('product_id');
        });

        Schema::dropIfExists('product_images');
    }
};