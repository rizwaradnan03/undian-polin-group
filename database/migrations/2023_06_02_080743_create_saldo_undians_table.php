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
        Schema::create('saldo_undians', function (Blueprint $table) {
            $table->string('norekening')->nullable();
            $table->float('point_sd_nov')->nullable();
            $table->float('point_dec')->nullable();
            $table->float('point_jan')->nullable();
            $table->float('point_feb')->nullable();
            $table->float('point_mar')->nullable();
            $table->float('point_apr')->nullable();
            $table->string('namalengkap')->nullable();
            $table->float('total_poin')->nullable();
            $table->float('saldo_akhir_periode')->nullable();
            $table->string('no_kupon')->nullable();
            $table->float('point_mei')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_undians');
    }
};
