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
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('os')->nullable();
            $table->string('isp')->nullable();
            $table->string('org')->nullable();
            $table->text('ports')->nullable();
            $table->json('vulns')->nullable(); // Untuk menyimpan data CVE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};