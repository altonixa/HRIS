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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->longText('benefits')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->string('location')->nullable();
            $table->enum('employment_type', ['Full-time', 'Part-time', 'Contract', 'Internship', 'Remote'])->default('Full-time');
            $table->string('salary_range')->nullable();
            $table->enum('status', ['Draft', 'Published', 'Closed'])->default('Draft');
            $table->date('closing_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('resume_path')->nullable(); // Path to PDF
            $table->text('cover_letter')->nullable(); 
            $table->enum('status', ['New', 'Screening', 'Interview', 'Offered', 'Rejected', 'Hired'])->default('New');
            $table->text('notes')->nullable(); // HR internal notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_postings');
    }
};
