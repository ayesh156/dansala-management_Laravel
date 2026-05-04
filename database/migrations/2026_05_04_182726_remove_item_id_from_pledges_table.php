<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pledges', function (Blueprint $table) {
            // First, drop the foreign key constraint
            $table->dropForeign(['item_id']);
            // Then drop the column
            $table->dropColumn('item_id');
            // Also drop pledged_quantity since it will be in pivot table
            $table->dropColumn('pledged_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('pledges', function (Blueprint $table) {
            $table->foreignId('item_id')->nullable()->constrained('items')->cascadeOnDelete();
            $table->decimal('pledged_quantity', 10, 2)->nullable();
        });
    }
};
