<?php

use App\Models\JobBoard;
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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobBoard::class)->nullable()->default(null);
            $table->string('name');
            $table->text('description');
            $table->string('office');
            $table->string('department');
            $table->enum('employment_type', \App\Enums\EmploymentType::toArray());
            $table->string('experience');
            $table->enum('schedule', \App\Enums\Schedule::toArray());
            $table->enum('seniority', \App\Enums\Seniority::toArray());
            $table->string('creator_email');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
