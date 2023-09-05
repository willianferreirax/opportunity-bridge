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
        Schema::create('opportunity_addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('opportunity_id')->nullable();
            $table->string("cep");
            $table->string("street");
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->string('neighborhood');

            $table->foreign('opportunity_id')
                ->references('id')
                ->on('opportunities')
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
        Schema::table('opportunity_addresses', function (Blueprint $table) {
            $table->dropForeign('opportunity_addresses_opportunity_id_foreign');
        });

        Schema::dropIfExists('opportunity_addresses');
    }
};
