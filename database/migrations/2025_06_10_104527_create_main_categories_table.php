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
        Schema::create('main_categories', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('translation_language', 10);
            $table->unsignedBigInteger('translation_of')->nullable(); 
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->string('photo', 150)->nullable();
            $table->tinyInteger('active')->default(1); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_categories');
    }
};
