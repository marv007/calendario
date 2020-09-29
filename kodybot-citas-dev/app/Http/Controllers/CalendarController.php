<?php

namespace App\Http\Controllers;

use App\Reservation;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $schedules = Reservation::all();
        return view('pages.calendar')->with('schedules', $schedules);
    }

    public function get()
    {
        return json_encode(Reservation::all());
    }
}
