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
    Schema::create('articles', function (Blueprint $table) {
      $table->id();
      $table
        ->foreignId('user_id')
        ->constrained()
        ->onDelete('cascade');
      $table->string('thumbnail_image')->nullable();
      $table->string('title_article');
      $table->string('category')->nullable();
      $table->longText('article_content');
      $table->date('date_written');
      $table->enum('status', ['Draft', 'Pending', 'Approved'])->default('Draft');
      $table->json('tags')->nullable();
      $table->timestamps();
    });
  }

  //function for view
  public function show($id)
  {
	$article = \App\Models\Article::findOrFail($id);
	return view('spj-content.publication-management.show', compact('article'));
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('articles');
  }
};
