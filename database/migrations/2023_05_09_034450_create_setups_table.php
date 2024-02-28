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
        Schema::create('setups', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nama');

            $table->unsignedBigInteger('periode_id')->default('1');
            $table->foreign('periode_id')->references('id')->on('sistems')->onDelete('cascade');

            $table->enum('status',['0','1'])->default('0');
            $table->integer('jumlah');
            $table->string('jumlah_display');
            $table->text('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};
