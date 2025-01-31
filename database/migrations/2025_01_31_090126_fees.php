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
            $table->string('transaction_type')->unique(); // e.g., 'send_money', 'external_api'
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });

        // Insert default fees
        DB::table('fees')->insert([
            ['transaction_type' => 'send_money', 'amount' => 1.00], // Default fee
            ['transaction_type' => 'external_api', 'amount' => 15.00] // Fixed fee for external transactions
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
