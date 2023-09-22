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
        Schema::create('video_interview', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opportunity_user_id');
            $table->unsignedBigInteger('video_step_id');
            $table->string('video_url');
            $table->timestamps();

            $table->foreign('opportunity_user_id')
                ->references('id')
                ->on('opportunity_user')
                ->onDelete('cascade');

            $table->foreign('video_step_id')
                ->references('id')
                ->on('video_steps')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //drop foreign keys
        Schema::table('video_interview', function (Blueprint $table) {
            $table->dropForeign(['opportunity_user_id']);
            $table->dropForeign(['interview_step_id']);
        });

        Schema::dropIfExists('video_interview');
    }
};
