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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('like');
            $table->string('description');
            $table->string('file');
            $table->json('tags');
            
            
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->unsignedBigInteger('comments_id');
            $table->foreign('comments_id')
            ->references('id')
            ->on('comments')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
