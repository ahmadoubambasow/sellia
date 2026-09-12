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
        Schema::table('sales', function (Blueprint $table) {
            
            $table->decimal('amount_paid', 15, 2)
                ->default(0)
                ->after('total');

            $table->enum('payment_method', [
                'cash',
                'wave',
                'orange_money',
                'card',
                'other',
            ])
                ->nullable()
                ->after('amount_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'amount_paid',
                'payment_method',
            ]);
        });
    }
};
