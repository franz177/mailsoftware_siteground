<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\BookingSincronizationJob;

class SyncBookings extends Command
{
    protected $signature = 'sync:bookings';
    protected $description = 'Esegue il job di sincronizzazione delle prenotazioni';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        BookingSincronizationJob::dispatch();
    }
}
