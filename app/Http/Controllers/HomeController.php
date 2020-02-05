<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function daysToMinutes($days)
    {
        $hours = $days * 24;
        return  $hours * 60;
    }


    public function index()
    {
        $minutes =  $this->daysToMinutes(7);

        $appointmentsByDay = Cache::remember('appointments_by_day', $minutes, function () {
            $results = Appointment::select([
                DB::RAW('DAYOFWEEK(scheduled_date) As day'),
                DB::RAW('COUNT(*) As count')
            ])
                ->whereIn('status', ['Confirmada', 'Atendida'])
                ->groupBy(DB::RAW('DAYOFWEEK(scheduled_date)'))
                ->get(['day', 'count'])
                ->mapWithKeys(function ($item) {
                    return [$item['day'] => $item['count']];
                })->toArray();

            $counts = [];
            for ($i = 1; $i <= 7; ++$i) {
                if (array_key_exists($i, $results))
                    $counts[] = $results[$i];
                else
                    $counts[] = 0;
            }
            return $counts;
        });
        return view('home', compact('appointmentsByDay'));
    }
}
