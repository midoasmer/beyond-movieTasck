<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\showTimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $movies = Movie::query()->where('status', 1)->get();
        $showtime = showTimes::query()->where('status', 1)->get();
        return view('admin.events.index', compact('events', 'movies', 'showtime'));
    }

    public function getEvents(Request $request)
    {
         $events = Event::query()->where('day', $request->day)->where('status', 1)->with(['movie','showtime'])->get();
         if(count($events) > 0){
             return response()->json([
                 'status' => 200,
                 'events' => $events,
                 'msg' => ''
             ]);
         }

        return response()->json([
            'status' => 400,
            'events' => [],
            'msg' => 'No Events Founded'
        ]);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'movie_id' => 'required',
            'showtime_id' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Event::updateOrCreate([
            'day' => $request->day,
            'show_times_id' => $request->showtime_id,
//            'movie_id' => $request->movie_id
        ],
            [
                'movie_id' => $request->movie_id,
                'status' => $request->status == 'on' ? 1 : 0
            ]);


        Session::flash('create', ' Event Created');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $event = Event::query()->where(['day' => $request->day,'show_times_id'=>$request->showtime_id])->first();
        if($event){
            $status = $request->status == 'on' ? 1 : 0;
            if(($request->id == $event->id && $status != $event->status) || ($request->id == $event->id && $event->movie_id != $request->movie_id)){
                Event::query()->where('id',$request->id)->update([
                    'status' => $status,
                    'movie_id' => $request->movie_id,
                ]);
                Session::flash('update', 'Event Updated');
                return redirect()->route('events.index');
            }
            Session::flash('error', 'This Event Already Exist');
            return redirect()->route('events.index');
        }

        Event::query()->where('id',$request->id)->update([
            'day' => $request->day,
            'show_times_id' => $request->showtime_id,
            'movie_id' => $request->movie_id,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Session::flash('update', 'Event Updated');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Event::query()->where('id',$request->id)->delete();
        Session::flash('delete', 'Event Deleted');
        return redirect()->route('events.index');
    }
}
