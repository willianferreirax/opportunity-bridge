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
        Schema::create('curriculum_pro_experiences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string("company_name");
            $table->string("role");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_current")->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('curriculum_pro_experiences', function (Blueprint $table) {
            $table->dropForeign('curriculum_pro_experiences_user_id_foreign');
        });

        Schema::dropIfExists('curriculum_pro_experiences');
    }
};
