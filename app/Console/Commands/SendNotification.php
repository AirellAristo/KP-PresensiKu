<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:send-notification';

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
        $employees = User::select('email', 'name')
            ->where('id_role', '!=', 1)
            ->get();

        foreach ($employees as $employee) {
            Mail::html(view('admin.karyawan.reminder_absent')->render(), function ($message) use ($employee) {
                $message->to($employee->email);
                $message->subject('Hai ' . $employee->name);
            });
        }
    }
}
