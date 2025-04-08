<?php

use App\Models\BankPartners;
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
            $table->text('api_key'); // API key for authentication
            $table->string('img_url');
            $table->string('description')->nullable();
            
            $table->timestamps(); // created_at and updated_at timestamps
        });

        #this is temporary
        // BankPartners::insert([
        //     ['name' => 'BPI', 'url' => 'https://api.bpi.com', 'api_key' => 'df3443dasd435','img_url'=>'bpi.png','description'=>'BPI / VYBE by BPI', 'created_at' => now()],
        //     ['name' => 'BDO', 'url' => 'https://api.bdo.com', 'api_key' => '434543sdfsd435','img_url'=>'bdo.png','description'=>'BDO Unibank, Inc', 'created_at' => now()],
        //     ['name' => 'Metrobank', 'url' => 'https://api.metrobank.com', 'api_key' => '456456sdfsdfsd','img_url'=>'metrobank.png','description'=>'Metropolitan Bank and Trust Co.', 'created_at' => now()],
           
        // ]);
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
