<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type'); // e.g., 'send_money', 'external_api'
            $table->string('currency', 3)->default('PHP'); // Currency code (PHP, USD, etc.)
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->unique(['transaction_type', 'currency']); // Prevent duplicate fees per transaction & currency
        });
    
        // Insert default fees
        DB::table('fees')->insert([
            ['transaction_type' => 'send_money', 'currency' => 'PHP', 'amount' => 1.00], // 1 Peso
            ['transaction_type' => 'send_money', 'currency' => 'USD', 'amount' => 0.20], // 20 cents (USD)
            ['transaction_type' => 'external_api', 'currency' => 'PHP', 'amount' => 15.00], // 15 PHP
            ['transaction_type' => 'external_api', 'currency' => 'USD', 'amount' => 3.00], // Example external fee for USD
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
};
