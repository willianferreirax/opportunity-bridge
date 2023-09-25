<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $data = [
            ["id" => "Masc", 'label' => 'Masculino'],
            ["id" => "Fem", 'label' => 'Feminino'],
            ["id" => "Nb", 'label' => 'Não-binario'],
            ["id" => "Tg", 'label' => 'Transgênero']

        ];

        DB::table('genders')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        //truncate
        DB::table("genders")->truncate();
    }
};
