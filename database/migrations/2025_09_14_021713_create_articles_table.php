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
            $table->string('title');
            $table->longText('description');
            $table->string('image_path')->nullable();
            $table->string('type')->default('Article');
            $table->string('category');
            $table->json('tags')->nullable();
            $table->date('date_submitted');
            $table->string('date_publish')->nullable();
            $table
                ->enum('status', ['Draft', 'Approved', 'Scheduled', 'Published', 'Revision', 'Rejected'])
                ->default('Draft');
            $table->string('remarks')->nullable();
            $table->timestamp('publish_at')->nullable();
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
