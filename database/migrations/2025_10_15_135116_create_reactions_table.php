<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('type'); // like, love, haha, wow, sad, angry
            $table->timestamps();

            $table->unique(['user_id', 'post_id']); // এক ইউজার একটাই reaction দিতে পারবে
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
