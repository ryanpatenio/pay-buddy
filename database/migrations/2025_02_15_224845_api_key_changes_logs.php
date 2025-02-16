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
        Schema::create('api_key_changes_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_key_id'); // Foreign key to api_keys table
            $table->string('action'); // e.g., 'created', 'revoked', 'regenerated'
            $table->text('details')->nullable(); // Additional details (e.g., reason for revocation)
            $table->unsignedBigInteger('performed_by')->nullable(); // User or system that performed the action
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint
            $table->foreign('api_key_id')->references('id')->on('api_keys')->onDelete('cascade');
            $table->foreign('performed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
