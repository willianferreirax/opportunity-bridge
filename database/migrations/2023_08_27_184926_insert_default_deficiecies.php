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
            ['deficiency' => 'Visual'],
            ['deficiency' => 'Auditiva'],
            ['deficiency' => 'Física'],
            ['deficiency' => 'Intelectual'],
            ['deficiency' => 'Múltipla'],
            ['deficiency' => 'Outra'],
        ];

        DB::table('deficiencies')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //truncate
        DB::table("deficiencies")->truncate();
    }
};
