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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string("cep");
            $table->string("street");
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->string('neighborhood');

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
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign('user_addresses_user_id_foreign');
        });

        Schema::dropIfExists('user_addresses');
    }
};
