<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index',compact('movies'));
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
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Movie::updateOrCreate([
            'name' => $request->name,
        ],
            [
                'status' => $request->status == 'on' ? 1 : 0
            ]);


        Session::flash('create', $request->name.' Movie Created');
        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $movie = Movie::query()->where('name',$request->name)->first();
        if($movie){
            $status = $request->status == 'on' ? 1 : 0;
            if($request->id == $movie->id && $status != $movie->status){
                Movie::query()->where('id',$request->id)->update([
                    'status' => $status
                ]);
                Session::flash('update', 'Movie Updated');
                return redirect()->route('movies.index');
            }
            Session::flash('error', 'This Movie Already Exist');
            return redirect()->route('movies.index');
        }

        Movie::query()->where('id',$request->id)->update([
            'name' => $request->name,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Session::flash('update', 'Movie Updated');
        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Movie::query()->where('id',$request->id)->delete();
        Session::flash('delete', 'Movie Deleted');
        return redirect()->route('movies.index');
    }
}
