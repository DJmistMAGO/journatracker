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
		Schema::create('media', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('title');
			$table->text('description')->nullable();
			$table->string('image_path')->nullable();
			$table->string('link')->nullable();
			$table->string('type')->default('Media');
			$table->string('category');
			$table->json('tags')->nullable();
			$table->date('date_submitted');
			$table->string('date_publish')->nullable();
			$table->enum('status', ['Draft', 'Published', 'Revision', 'Rejected'])->default('Draft');
			$table->string('remarks')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('media');
	}
};
