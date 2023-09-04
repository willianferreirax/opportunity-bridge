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
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id')->nullable();
            $table->string("cep");
            $table->string("street");
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->string('neighborhood');
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //drop foreign keys
        Schema::table('company_addresses', function (Blueprint $table) {
            $table->dropForeign('company_addresses_company_id_foreign');
        });

        Schema::dropIfExists('company_addresses');
    }
};
