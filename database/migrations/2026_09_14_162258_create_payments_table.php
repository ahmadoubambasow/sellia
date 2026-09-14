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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('sale_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            $table->decimal('amount', 15, 2);

            $table->enum('payment_method', [
                'cash',
                'wave',
                'orange_money',
                'card',
                'other',
            ]);

            $table->timestamp('paid_at');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['sale_id', 'paid_at']);
            $table->index(['user_id', 'paid_at']);
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
