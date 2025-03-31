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
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
         
            $table->text('api_key')->unique(); // Unique API key for each user
            $table->string('callback_url')->nullable(); // Optional callback URL for third-party integrations
            $table->enum('status', ['active', 'inactive', 'revoked'])->default('active');
            $table->timestamp('expires_at')->nullable(); // Expiration date   

            $table->timestamps();

            $table->timestamp('revoked_at')->nullable(); // When the key was revoked
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_keys');
    }
};
