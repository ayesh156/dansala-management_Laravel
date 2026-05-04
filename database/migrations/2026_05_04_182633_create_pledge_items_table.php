<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pledge_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pledge_id')->constrained('pledges')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->decimal('pledged_quantity', 10, 2)->nullable();
            $table->timestamps();
            
            // Ensure unique combination of pledge and item
            $table->unique(['pledge_id', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pledge_items');
    }
};
