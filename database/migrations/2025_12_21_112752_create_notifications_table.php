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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); //(order أو message) نوع الإشعار 
            $table->unsignedBigInteger('related_id'); // رقم الطلب أو الرسالة أو غيره
            $table->string('title')->nullable(); // عنوان الإشعار
            $table->text('body')->nullable(); // وصف مختصر
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
