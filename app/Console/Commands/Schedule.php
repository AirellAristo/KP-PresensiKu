<?php

namespace App\Console\Commands;

use App\Models\Absent;
use App\Models\User;
use App\Models\Izin;
use App\Models\company;
use Illuminate\Console\Command;

class Schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:buka-presensi';

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
        $getIDUser = [];
        $getIDIzin = [];
        $users = User::select('id')
            ->where('id_role', '!=', 1)
            ->get();
        $izin = Izin::select('id_user')
            ->whereRaw('CURRENT_DATE <= date(akhir)')
            ->where('status','Setuju')
            ->get();
        foreach($users as $idEmployee){
            $getIDUser[] = $idEmployee->id;
        };

        foreach($izin as $idIzin){
            $getIDIzin[] = $idIzin->id_user;
        };

        $result = array_diff($getIDUser, $getIDIzin);
        foreach ($result as $presensi) {
                $absent = new Absent();
                $absent->id_user = $presensi;
                $absent->status = 'alpha';
                $absent->save();
            }
        company::query()->update(['status' => 'buka']);
        }
}
