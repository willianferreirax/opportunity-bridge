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
        Schema::create('user_deficiency', function (Blueprint $table) {
            $table->id();

            $table->uuid('user_id')->nullable();
            $table->uuid('deficiency_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('user_deficiency', function (Blueprint $table) {
            $table->dropForeign('user_deficiency_user_id_foreign');
            $table->dropForeign('user_deficiency_deficiency_id_foreign');
        });

        Schema::dropIfExists('user_deficiency');
    }
};
