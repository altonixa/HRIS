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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('weight', 5, 2)->default(0); // e.g., 20.00 (%)
            $table->decimal('target_value', 15, 2)->nullable();
            $table->string('unit')->nullable(); // e.g., %, USD, Tasks
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('appraisals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade');
            $table->date('period_start');
            $table->date('period_end');
            $table->enum('status', ['Draft', 'Submitted', 'Reviewed', 'Finalized'])->default('Draft');
            $table->decimal('total_score', 5, 2)->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });

        Schema::create('appraisal_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_id')->constrained()->onDelete('cascade');
            $table->foreignId('kpi_id')->constrained()->onDelete('cascade');
            $table->decimal('self_score', 5, 2)->nullable();
            $table->decimal('manager_score', 5, 2)->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appraisal_metrics');
        Schema::dropIfExists('appraisals');
        Schema::dropIfExists('kpis');
    }
};
