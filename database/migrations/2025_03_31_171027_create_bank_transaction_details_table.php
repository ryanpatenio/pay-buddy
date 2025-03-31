<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('bank_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained('bank_partners')->cascadeOnDelete();
            $table->string('receiver_name');
            $table->string('receiver_account_number');
           
            $table->decimal('sender_balance_before');
            $table->decimal('sender_balance_after');
            $table->json('api_response')->nullable(); // Store full API response
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transaction_details');
    }
};
