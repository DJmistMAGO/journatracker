<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('pub_management', function (Blueprint $table) {
      $table->id();
      $table
        ->foreignId('article_id')
        ->constrained()
        ->onDelete('cascade');
      $table->dateTime('publication_date')->nullable();
      $table->boolean('is_published')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pub_management');
  }
};
