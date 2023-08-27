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
            ["id" => "Pnr", 'label' => 'Prefiro não responder'],
            ["id" => "Gn", 'label' => 'Gênero neutro'],
            ["id" => "Ag", 'label' => 'Agênero']
        ];

        DB::table('genders')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //truncate
        DB::table("genders")->truncate();
    }
};
