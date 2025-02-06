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
        Schema::create('bank_partners', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key

            $table->string('name'); // Name of the bank
            $table->string('url'); // Base URL of the bank's API
            $table->string('api_key'); // API key for authentication
            
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_partners');
    }
};
