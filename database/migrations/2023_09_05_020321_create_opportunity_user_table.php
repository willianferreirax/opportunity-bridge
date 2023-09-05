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
        Schema::create('opportunity_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('opportunity_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->integer('current_step')->nullable();
            $table->string('status')->nullable();

            $table->foreign('opportunity_id')
                ->references('id')
                ->on('opportunities')
                ->onDelete('set null');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('opportunity_user', function (Blueprint $table) {
            $table->dropForeign('opportunity_user_opportunity_id_foreign');
            $table->dropForeign('opportunity_user_user_id_foreign');
        });

        Schema::dropIfExists('opportunity_user');
    }
};
