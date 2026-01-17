<?php

use Illuminate\Support\Facades\Schedule;
use App\Jobs\Schedule\ClearDatabaseCacheJob;


Schedule::job(new ClearDatabaseCacheJob())
    ->dailyAt('00:00')
    ->onOneServer()
    ->withoutOverlapping(180);