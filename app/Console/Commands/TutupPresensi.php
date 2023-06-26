<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\company;

class TutupPresensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:tutup-presensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        company::query()->update(['status' => 'tutup']);
    }
}
