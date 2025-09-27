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
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
			$table->string('student_name');
			$table->string('student_id_image');
			$table->string('incident_description');
			$table->string('image_proof');
			$table->date('date_submitted')->default(now());
			$table->date('date_status')->default(now());
			$table->enum('status', ['Pending', 'Under Review', 'Resolved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
