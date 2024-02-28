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
        Schema::create('undians', function (Blueprint $table) {
            $table->id();
            $table->string('noacc');
            $table->string('no_undian');
            $table->string('nama_lengkap');
            $table->string('point');

            $table->unsignedBigInteger('periode_id')->default('1');
            $table->foreign('periode_id')->references('id')->on('sistems')->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->default('1');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undians');
    }
};
