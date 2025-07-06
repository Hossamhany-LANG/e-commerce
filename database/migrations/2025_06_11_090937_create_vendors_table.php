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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 150);
            $table->string('phone' , 100);
            $table->text('address');
            $table->string('email' , 150)->nullable();
            $table->string('password');
            $table->tinyInteger('active')->default(0);
            $table->string('logo' , 200);
            $table->foreignId('category_id')->constrained('main_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
