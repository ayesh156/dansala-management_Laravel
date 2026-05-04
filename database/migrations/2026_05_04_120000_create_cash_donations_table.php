<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('donor_mobile')->nullable();
            $table->string('donor_address')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_donations');
    }
};
