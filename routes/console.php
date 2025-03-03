<?php

// php artisan schedule:work

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:daily-notification')->everyMinute();
Schedule::command('app:deadline-notification')->everyMinute();