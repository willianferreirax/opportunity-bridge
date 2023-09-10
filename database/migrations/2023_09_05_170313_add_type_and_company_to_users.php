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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('type', ['candidate', 'company'])->default('candidate');
            $table->uuid('company_id')->nullable();
            $table->string('role')->nullable();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');

            //make cpf nullable
            $table->bigInteger('cpf')->nullable()->change();

            //make birth_date nullable
            $table->date('birth_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropForeign('users_company_id_foreign');

        });
    }
};
