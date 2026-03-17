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
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->double('price');
            $table->integer('quantity')->default(0);
            $table->string('photo' , 200);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('category_id')->constrained('main_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subcategory_id')->constrained('sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
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
