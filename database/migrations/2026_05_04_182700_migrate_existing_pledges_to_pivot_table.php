<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Migrate existing pledges to the new pivot table structure
        $pledges = DB::table('pledges')->get();
        
        foreach ($pledges as $pledge) {
            if ($pledge->item_id) {
                DB::table('pledge_items')->insert([
                    'pledge_id' => $pledge->id,
                    'item_id' => $pledge->item_id,
                    'pledged_quantity' => $pledge->pledged_quantity,
                    'created_at' => $pledge->created_at,
                    'updated_at' => $pledge->updated_at,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Clear the pivot table
        DB::table('pledge_items')->truncate();
    }
};
