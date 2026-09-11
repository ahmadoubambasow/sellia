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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('shop_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', [
                'entry',
                'exit',
                'adjustment',
            ]);

            $table->unsignedInteger('quantity');

            $table->string('reason')->nullable();

            $table->string('reference')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index([
                'shop_id',
                'product_id',
            ]);

            $table->index([
                'shop_id',
                'type',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
