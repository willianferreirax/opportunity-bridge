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
        Schema::create('interview', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opportunity_user_id');
            $table->unsignedBigInteger('interview_step_id');
            $table->dateTime('date');
            $table->timestamps();

            $table->foreign('opportunity_user_id')
                ->references('id')
                ->on('opportunity_user')
                ->onDelete('cascade');

            $table->foreign('interview_step_id')
                ->references('id')
                ->on('interview_steps')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //drop foreign keys
        Schema::table('interview', function (Blueprint $table) {
            $table->dropForeign(['opportunity_user_id']);
            $table->dropForeign(['interview_step_id']);
        });

        Schema::dropIfExists('interview');
    }
};
