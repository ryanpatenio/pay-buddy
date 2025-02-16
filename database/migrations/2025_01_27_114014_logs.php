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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('api_key_id')->nullable()->constrained()->onDelete('cascade'); // API key associated with the request

            $table->text('request_data'); // JSON request payload
            $table->text('response_data'); // JSON response payload

            $table->string('status')->default('success'); // Log status (e.g., success, error)

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
        Schema::dropIfExists('logs');
    }
};
