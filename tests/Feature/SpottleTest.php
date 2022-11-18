<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class SpottleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_reminder()
    {
        $url = ('https://quiet-journey-11397.herokuapp.com/mypage');

        $today = Carbon::today();
        $user_id = Reservation::wheredate('start_at', $today)->pluck('user_id')->toArray();

        if($user_id){
            $user = array_unique($user_id);

            $today = collect();
            foreach($user as $user){
                $result = User::where('id', $user)->get();
                $today = $today->concat($result);
            }

            foreach($today as $todays_user){
                Mail::to($todays_user->email)->send(new ReminderMail($todays_user, $url));
            }
        }
    }
}
