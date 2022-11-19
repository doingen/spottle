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
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_before_reminder()
    {
        Reservation::create([
            'user_id'=>'1',
            'spot_id'=>'2',
            'aircraft_id'=>'3',
            'tel'=>'01234556789',
            'start_at'=>now()->addHour(),
            'end_at'=>now()->addDay()
            ]);

        $today = Carbon::today();
        $user_id = Reservation::wheredate('start_at', $today)->pluck('user_id')->toArray();
        
        $this->assertNotnull($user_id);
    }
}
