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
        Schema::create('salary_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_structure_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., Housing, Transport, Tax
            $table->enum('type', ['earning', 'deduction']);
            $table->decimal('amount', 12, 2)->default(0);
            $table->boolean('is_percentage')->default(false);
            $table->decimal('percentage_value', 5, 2)->nullable(); // e.g., 5.00%
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_components');
    }
};
