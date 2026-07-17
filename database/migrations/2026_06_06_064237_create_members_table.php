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
    Schema::create('members', function (Blueprint $table) {
      $table->id()->primary();
      $table->foreignId('position_id')->nullable()->constrained('positions');
      $table->string('profile_photo')->nullable();
      $table->string('imagekit_file_id')->nullable();
      $table->string('full_name');
      $table->string('email')->unique();
      $table->date('join_date');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('members');
  }
};
