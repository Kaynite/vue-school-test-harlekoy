<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update random user with random data.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::inRandomOrder()->first()?->update([
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'timezone' => fake()->randomElement(['CET', 'CST', 'GMT+1']),
        ]);

        $this->info('User data updated successfully.');
    }
}
