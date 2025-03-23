<?php

namespace App\Console\Commands;

use App\Models\Api_keys;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckApiKeyExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and revoke expired API keys';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       // Get the current timestamp
       $now = Carbon::now();

       // Find all API keys where expires_at is in the past and status is not already revoked
       $expiredKeys = Api_keys::where('expires_at', '<', $now)
                            ->where('status', '!=', 'revoked')
                            ->get();

       // Update the status of expired keys to 'revoked'
       foreach ($expiredKeys as $key) {
           $key->status = 'revoked';
           $key->save();
       }

       $this->info('Expired API keys have been revoked.');
    }
}
