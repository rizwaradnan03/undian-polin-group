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
        Schema::create('sistems', function (Blueprint $table) {
            $table->id();
            $table->text('nama_periode');
            $table->date('tgl_expired');
            $table->enum('status',['0','1'])->default('0');
            $table->timestamps();
        });
        DB::table('sistems')->insert(
            array(
                [
                    'nama_periode' => '02 JUNI 2022 - 31 MEI 2023',
                    'tgl_expired' => '2023-05-31'
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistems');
    }
};
