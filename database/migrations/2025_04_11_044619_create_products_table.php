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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('image');
            $table->decimal('base_price', 10, 2);
            $table->decimal('override_price', 10, 2)->nullable();
            $table->date('override_start_date')->nullable();
            $table->date('override_end_date')->nullable();
            $table->integer('stock_quantity');
            $table->text('description_en');
            $table->text('description_es');
            $table->string('tags')->nullable(); 
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
