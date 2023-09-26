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

        ];

        DB::table('skins')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("skins")->truncate();
    }
};
