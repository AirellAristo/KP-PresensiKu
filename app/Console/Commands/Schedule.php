<?php

namespace App\Console\Commands;

use App\Models\Absent;
use App\Models\User;
use App\Models\Izin;
use Illuminate\Console\Command;

class Schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:check-attendance';

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
                ->whereRaw('CURRENT_DATE() = date(mulai) or CURRENT_DATE <= date(akhir)')
                ->get();

        foreach($users as $idEmployee){
            $getIDUser[] = $idEmployee->id;
        };

        foreach($izin as $idIzin){
            $getIDIzin[] = $idIzin->id_user;
        };
        $result = array_diff($getIDUser, $getIDIzin);

        foreach ($result as $presensi) {
            // if ($izin[0]->id_user != $user->id){
                $absent = new Absent();
                $absent->id_user = $presensi;
                $absent->status = 'alpha';
                $absent->save();
            }
        }
    // }
}
