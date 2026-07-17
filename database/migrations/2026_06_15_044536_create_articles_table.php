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
        Schema::create('articles', function (Blueprint $table) {
            $table->id()->primary(); 
            $table->foreignId('author_id')->constrained('users'); 
            $table->foreignId('category_id')->constrained('article_categories');
            $table->string('imagekit_file_id')->nullable();
            $table->string('thumbnail_photo')->nullable();
            $table->string('title'); 
            $table->longText('content');
            $table->json('tags'); 
            $table->string('status')->default('draft'); 
            $table->boolean('is_pinned')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
