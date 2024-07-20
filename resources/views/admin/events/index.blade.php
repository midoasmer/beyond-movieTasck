@extends('layouts.dashborde')

@section('content')
    <div class="col-9">
        @if(Session::has('create'))
            <p class="alert alert-info">{{ Session::get('create') }}</p>
        @endif
        @if(Session::has('update'))
            <p class="alert alert-info">{{ Session::get('update') }}</p>
        @endif

            @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
        @if(Session::has('delete'))
            <p class="alert alert-danger">{{ Session::get('delete') }}</p>
            @endif


            </br>
            </br>
            </br>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#creatModal">
                Create New Event
            </button>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Day</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Showtime</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        @endphp
                    @foreach($events as $key => $event)
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>{{$event->day->format('l jS \o\f F')}}</td>
                            <td>{{$event->movie->name}}</td>
                            <td>{{$event->showtime->from->format('g:i A').'/'.$event->showtime->to->format('g:i A')}}</td>
                            <td>
                                @if ($event->status == 1)
                                    <span class="text-success"> Active </span>
                                @else
                                    <span class="text-danger">Unactive</span>
                                @endif
                            </td>
                            <td>

                                <button type="button"
                                        onclick="update(<?php echo htmlspecialchars(json_encode($event)) ?>,<?php echo htmlspecialchars(json_encode($showtime)) ?>,<?php echo htmlspecialchars(json_encode($movies)) ?>);"
                                        class="btn btn-warning buton" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button"
                                        onclick="remove(<?php echo htmlspecialchars(json_encode($event->id)) ?>);"
                                        class="btn btn-danger buton" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    <i class="fas fa-minus-circle "></i>
                                </button>
                            </td>
                        </tr>
                        @php
                            @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>


    <!-- Create Modal -->
    <div class="modal fade" id="creatModal" tabindex="-1" aria-labelledby="creatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creat New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('events.create')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label>Event Day</label>
                            <input type="date" class="form-control" name="day" aria-describedby="basic-addon1"
                                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            <label>Event Showtime</label>
                            <select class="form-select" name="showtime_id" aria-label="Default select example" required>
                                @foreach($showtime as $time)
                                    <option
                                        value="{{$time->id}}">{{$time->from->format('g:i A').'/'.$time->to->format('g:i A')}}</option>
                                @endforeach
                                {{--                                <option selected>Open this select menu</option>--}}
                            </select>
                            <label>Event Movie</label>
                            <select class="form-select" name="movie_id" aria-label="Default select example" required>
                                @foreach($movies as $movie)
                                    <option value="{{$movie->id}}">{{$movie->name}}</option>
                                @endforeach
                                {{--                                <option selected>Open this select menu</option>--}}
                            </select>
                            </br>
                            <label>status</label>
                            <input type="checkbox" name="status" checked>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('events.update')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label>Event Day</label>
                            <input type="date" class="form-control" id="dayUpdate" name="day"
                                   aria-describedby="basic-addon1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            <label>Event Showtime</label>
                            <select class="form-select" id="update_showtime_id" name="showtime_id"
                                    aria-label="Default select example" required>
                            </select>
                            <label>Event Movie</label>
                            <select class="form-select" id="update_movie_id" name="movie_id"
                                    aria-label="Default select example" required>
                            </select>
                            </br>
                            <label>status</label>
                            <input type="checkbox" name="status" id="updateStatus">
                            <input type="hidden" id="updateId" name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('events.delete')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            Are You Sure You Will Delete The Event?
                            <input type="hidden" name="id" id="deleteId" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        function update(event, showtime, movies) {
            console.log(event.day);
            document.getElementById('dayUpdate').value = event.day;

            let option = '';
            showtime.forEach(function (time) {
                option += `<option value="${time.id}" ${event.show_times_id == time.id ? 'selected' : ''}>${formatTime(time.from)}/${formatTime(time.to)}</option>`;
            });
            document.getElementById('update_showtime_id').innerHTML = option;

            let option2 = '';
            movies.forEach(function (movie) {
                option2 += `<option value="${movie.id}" ${event.movie_id == movie.id ? 'selected' : ''}>${movie.name}</option>`;
            });
            document.getElementById('update_movie_id').innerHTML = option2;

            document.getElementById('updateStatus').checked = event.status;
            document.getElementById('updateId').value = event.id;
        }

        function remove(id) {
            document.getElementById('deleteId').value = id;
        }


        function formatTime(time) {
            let [hours, minutes] = time.split(':');
            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            let strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

    </script>

@endsection
