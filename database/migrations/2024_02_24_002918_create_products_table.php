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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->bigInteger('category_id')->unsigned(); // almacenar el valor
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // indice
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity');
            $table->decimal('cost', 12, 2);
            $table->decimal('price', 12, 2);
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->timestamps();
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
