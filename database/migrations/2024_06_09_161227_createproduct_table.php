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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->float('price', 8, 2, true)->unsigned();
            $table->text('shortDescription');
            $table->unsignedInteger('quantity');
            $table->string('shipping', 255);
            $table->float('weight', 8, 2, true)->unsigned();
            $table->string('image_url', 255);
            $table->text('description');
            $table->text('informations');
            $table->text('review');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};