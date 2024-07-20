<?php

namespace App\Http\Controllers;

use App\Models\showTimes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShowTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showTimes = showTimes::all();
        return view('admin.show_times.index',compact('showTimes'));
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
            'from' => 'required',
            'to' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        showTimes::updateOrCreate([
           'from' => $request->from,
        'to' => $request->to
        ],
        [
            'status' => $request->status == 'on' ? 1 : 0
        ]);

        $from = Carbon::createFromFormat('H:i', $request->from);
        $to = Carbon::createFromFormat('H:i', $request->to);

        Session::flash('create', 'Showtime '.$from->format('g:i A').'/'.$to->format('g:i A').' Created');
        return redirect()->route('show_times.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(showTimes $showTimes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(showTimes $showTimes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $showtime = showTimes::query()->where(['from' => $request->from,'to' => $request->to])->first();

        if($showtime){
            $status = $request->status == 'on' ? 1 : 0;
            if($request->id == $showtime->id && $status != $showtime->status){
                showTimes::query()->where('id',$request->id)->update([
                    'status' => $status
                ]);

                Session::flash('update', 'Showtime Updated');
                return redirect()->route('show_times.index');
            }
            Session::flash('error', 'This Showtime Already Exist');
            return redirect()->route('show_times.index');
        }

        showTimes::query()->where('id',$request->id)->update([
            'from' => $request->from,
            'to' => $request->to,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Session::flash('update', 'Showtime Updated');
        return redirect()->route('show_times.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        showTimes::query()->where('id',$request->id)->delete();
        Session::flash('delete', 'Showtime Deleted');
        return redirect()->route('show_times.index');
    }
}
