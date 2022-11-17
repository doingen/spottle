<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\Mail\ReminderMail;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class ReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email to remind users of their reservation.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = ('/mypage');

        $today = Carbon::today();
        $user_id = Reservation::wheredate('start_at', $today)->pluck('user_id')->toArray();

        $user = array_unique($user_id);

        $today = collect();
        foreach($user as $user){
            $result = User::where('id', $user)->get();
            $today = $today->concat($result);
        }

        foreach($today as $todays_user){
            Mail::to($todays_user)->send(new ReminderMail($todays_user, $url));
        }
    }
}
