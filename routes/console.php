<?php

// php artisan schedule:work

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:daily-notification')->dailyAt('11:15'); //dailyAt('08:00');
Schedule::command('app:deadline-notification')->dailyAt('23:59'); //dailyAt('23:59');