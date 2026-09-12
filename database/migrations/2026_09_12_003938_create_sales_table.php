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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('shop_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('reference')
                ->unique();

            $table->decimal('subtotal', 15, 2)
                ->default(0);

            $table->decimal('discount', 15, 2)
                ->default(0);

            $table->decimal('total', 15, 2)
                ->default(0);

            $table->enum('status', [
                'completed',
                'cancelled',
            ])->default('completed');

            $table->enum('payment_status', [
                'unpaid',
                'partial',
                'paid',
            ])->default('unpaid');

            $table->timestamp('sold_at');

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->index(['shop_id', 'sold_at']);
            $table->index(['shop_id', 'status']);
            $table->index(['shop_id', 'payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
