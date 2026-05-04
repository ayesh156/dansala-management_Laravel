<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cash_donations', function (Blueprint $table) {
            if (!Schema::hasColumn('cash_donations', 'amount')) {
                $table->decimal('amount', 12, 2)->nullable()->after('donor_address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cash_donations', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
};
