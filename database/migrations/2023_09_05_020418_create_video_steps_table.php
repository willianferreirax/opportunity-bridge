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
        Schema::create('video_steps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('limit_days')->nullable();
            $table->uuid('opportunity_id')->nullable();
            $table->integer('order');
            $table->timestamps();

            $table->foreign('opportunity_id')
                ->references('id')
                ->on('opportunities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('video_steps', function (Blueprint $table) {
            $table->dropForeign('video_steps_opportunity_id_foreign');
        });

        Schema::dropIfExists('video_steps');
    }
};
