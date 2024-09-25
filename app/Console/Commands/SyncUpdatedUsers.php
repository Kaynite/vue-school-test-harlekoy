<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncUpdatedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync updated users to the external service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $users */
        $users = User::query()
            ->select('id', 'first_name', 'last_name', 'email', 'timezone')
            ->notSynced()
            ->get();

        if ($users->isNotEmpty()) {
            // Http::post('API_URL', [
            //     'batches' => [
            //         'subscribers' => $users->toArray()
            //     ]
            // ]);
        }

        User::query()
            ->whereIn('id', $users->pluck('id'))
            ->update(['is_synced' => true]);

        $users->each(function (User $user) {
            info("[{$user->id}] firstname: {$user->first_name}, email: {$user->email}, timezone: {$user->timezone}");
        });

        $this->info('Users synced successfully.');
    }
}
