<?php

use App\Models\currency;
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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // Currency code (e.g., 'USD', 'PHP')
            $table->string('name');  // Currency name (e.g., 'US Dollar', 'Philippine Peso')
            $table->string('symbol');  // Currency symbol (e.g., '$', '₱')
            $table->timestamps();
        });
      

        currency::insert([
            ['code' => 'PHP', 'name' => '🇵🇭 PHP', 'symbol' => '₱', 'created_at' => now(), 'updated_at'=>now()],
            ['code' => 'USD', 'name' => '🇺🇸 USD', 'symbol' => '$', 'created_at' => now(), 'updated_at'=>now()],
            ['code' => 'EUR', 'name' => '🇪🇺 EUR', 'symbol' => '€', 'created_at' => now(), 'updated_at'=>now()],
           
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
