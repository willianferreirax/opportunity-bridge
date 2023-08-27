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
            ["id" => "B", 'label' => 'Branca'],
            ["id" => "Pt", 'label' => 'Preta'],
            ["id" => "A", 'label' => 'Amarela'],
            ["id" => "Pd", 'label' => 'Parda'],
        ];

        DB::table('skins')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //truncate table
        DB::table('skins')->truncate();
    }
};
