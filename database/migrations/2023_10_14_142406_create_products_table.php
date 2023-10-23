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
            $table->id();
            $table->string('name');
            $table->text('thumbnail');
            $table->string('price');

            $table->text('image_datail');
            $table->string('product_datail');
            $table->text('desc');
            $table->integer('status');
            $table->timestamps();
            $table
                ->foreignId('catalog_id')
                ->constrained('catalogs')
                ->onDelete('cascade');
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