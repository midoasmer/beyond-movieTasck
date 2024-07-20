<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        $events = Event::query()->where('status', 1)->get();
        $attendees = Attendee::all();
        return view('admin.bookings.index', compact('events', 'bookings', 'attendees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobil' => 'required|numeric',
//            'email' => 'required|email|unique:attendees,email',
//            'mobil' => 'required|numeric|unique:attendees,mobil',
            'event_id' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        $attendee = Attendee::updateOrCreate([
            'email' => $request->email,
            'mobil' => $request->mobil,
            'name' => $request->name,
        ]);

        Booking::updateOrCreate([
            'attendee_id' => $attendee->id,
            'event_id' => $request->event_id,
        ]);

        Session::flash('create', ' Booking Created');
        return redirect()->route('home');
//        $validator->errors();
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
