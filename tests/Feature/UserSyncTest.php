<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

test('desynced users will be updated.', function () {
    Http::fake();

    $users = User::factory(20)->create([
        'is_synced' => false,
    ]);

    Artisan::call('users:sync');

    $users->each(function (User $user) {
        expect($user->fresh()->is_synced)->toBeTrue();
    });
});

test('user will be marked as desynced after update', function () {
    $user = User::factory()->create([
        'is_synced' => true,
    ]);

    $user->update([
        'first_name' => 'John',
    ]);

    expect($user->fresh()->is_synced)->toBeFalse();
});
