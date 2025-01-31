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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('wallet_id')->constrained()->onDelete('cascade'); // Link to the wallet
            $table->foreignId('receiver_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade'); // Optional receiver wallet
            $table->foreignId('api_key_id')->nullable()->constrained()->onDelete('cascade'); // Optional for third-party API transactions

            $table->string('transaction_id')->unique();
            $table->string('client_ref_id')->nullable();

            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 15, 2);
            
            $table->decimal('fee', 15, 2);

            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('description')->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
