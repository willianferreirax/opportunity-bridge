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
        Schema::create('user_personal_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string("sex")->nullable();
            $table->string('skin_id')->nullable();
            $table->string("gender_id")->nullable();
            $table->string("nacionality")->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');


            $table->foreign('skin_id')
                ->references('id')
                ->on('skins')
                ->onDelete('set null');

            $table->foreign('gender_id', 'user_personal_data_gnd_id_foreign')
                ->references('id')
                ->on('genders')
                ->onDelete('set null');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('user_personal_data', function (Blueprint $table) {
            $table->dropForeign('user_personal_data_user_id_foreign');
        });

        Schema::table('user_personal_data', function (Blueprint $table) {
            $table->dropForeign('user_personal_data_skin_id_foreign');
        });

        Schema::table('user_personal_data', function (Blueprint $table) {
            $table->dropForeign('user_personal_data_gnd_id_foreign');
        });


        Schema::dropIfExists('user_personal_data');
    }
};
