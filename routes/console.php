<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\ShortSchedule\Facades\ShortSchedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

ShortSchedule::command('users:sync')->everySeconds(90); // Or every 72 seconds.
