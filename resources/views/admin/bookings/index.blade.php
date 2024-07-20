@extends('layouts.dashborde')

@section('content')
    <div class="col-9">
        @if(Session::has('create'))
            <p class="alert alert-info">{{ Session::get('create') }}</p>
        @endif
        @if(Session::has('update'))
            <p class="alert alert-info">{{ Session::get('update') }}</p>
        @endif
        @if(Session::has('delete'))
            <p class="alert alert-danger">{{ Session::get('delete') }}</p>
            @endif


            </br>
            </br>
            </br>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Attendee</th>
                        <th scope="col">Event</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        @endphp
                    @foreach($bookings as $key => $booking)
                        <tr>
                            <td>{{$booking->id}}</td>
                            <td>{{$booking->attendee->name}}</br>
                                {{$booking->attendee->email}}</br>
                                {{$booking->attendee->mobil}}
                            </td>
                            <td>{{$booking->event->movie->name}}</br>
                                {{$booking->event->day->format('l jS \o\f F')}}</br>
                                {{$booking->event->showtime->from->format('g:i A')}}/
                                {{$booking->event->showtime->to->format('g:i A')}}
                            </td>
                        </tr>
                        @php
                            @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>


@endsection
