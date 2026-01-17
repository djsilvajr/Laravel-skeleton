<?php

namespace App\Jobs\Schedule;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ClearDatabaseCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Optional safety settings
    public int $timeout = 120;
    public int $tries = 1;

    public function handle(): void
    {
        $startOfToday = Carbon::today()->startOfDay()->timestamp;

        $deleted = DB::table('cache')
            ->where('expiration', '<', $startOfToday)
            ->delete();

        Log::info("Expired database cache cleaned", [
            'deleted_rows' => $deleted,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
