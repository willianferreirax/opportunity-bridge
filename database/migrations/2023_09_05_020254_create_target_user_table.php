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
        Schema::create('target_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('opportunity_id')->nullable();
            $table->unsignedBigInteger('deficiency_id')->nullable();
            $table->timestamps();

            $table->foreign('opportunity_id')
                ->references('id')
                ->on('opportunities')
                ->onDelete('set null');

            $table->foreign('deficiency_id')
                ->references('id')
                ->on('deficiencies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('target_user', function (Blueprint $table) {
            $table->dropForeign('target_user_opportunity_id_foreign');
            $table->dropForeign('target_user_deficiency_id_foreign');
        });

        Schema::dropIfExists('target_user');
    }
};
