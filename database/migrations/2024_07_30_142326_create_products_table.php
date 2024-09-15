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
            // Rating added manually
            $table->id();
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->float('product_price');
            $table->float('product_discount')->default(0); // Set default value
            $table->float('product_weight')->nullable(); // Allow null values
            $table->string('product_video')->nullable(); // Allow null values
            $table->string('main_image')->nullable(); // Allow null values
            $table->text('description')->nullable(); // Allow null values
            $table->string('wash_care')->nullable(); // Allow null values
            $table->string('fabric')->nullable(); // Allow null values
            $table->string('pattern')->nullable(); // Allow null values
            $table->string('sleeve')->nullable(); // Allow null values
            $table->string('fit')->nullable(); // Allow null values
            $table->string('occasion')->nullable(); // Allow null values
            $table->string('meta_title')->nullable(); // Allow null values
            $table->string('meta_description')->nullable(); // Allow null values
            $table->string('meta_keywords')->nullable(); // Allow null values
            $table->enum('is_featured', ['No', 'Yes'])->default('No'); // Set default value
            $table->tinyInteger('status')->default(1); // Set default value (e.g., 1 for active)
            $table->string('url'); // Add the url column
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
