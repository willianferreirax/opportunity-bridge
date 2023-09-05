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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("name");
            $table->string("role");
            $table->string("resume");
            $table->string("status");
            $table->string("hiring_regime");
            $table->string("job_type");
            $table->string("work_start");
            $table->string("work_end");
            $table->float("salary_start");
            $table->float("salary_end");
            $table->integer("vacancies");
            $table->text("benefits");
            $table->boolean("is_pcd")->default(false);
            $table->text("competences");
            $table->text("requirements");
            $table->text("responsabilities");
            $table->boolean("is_remote")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
