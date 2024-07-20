@extends('layouts.minapp')

@section('content')
    <section class="trending-products " id="our-product">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('create'))
            <p class="alert alert-info">{{ Session::get('create') }}</p>
        @endif
        <div class="container">
            <div class="row text-center">
                <h2>Theatre</h2>
                <div class="row text-center">
                    <label>Select Day</label>

                    <input type="date" onchange="getEvents();" class="form-control" id="daySelect" name="day"
                           aria-describedby="basic-addon1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>

            </div>
            </br>
            <div class="alert alert-danger text-center" id="massDev" role="alert" style="display: none">
                Now Events Founded For This Day
            </div>


            <div class="input-group text-center" id="eventsDev" style="display: none">
                <label>Select Movie</label>
                <div class="input-group-text text-center" id="events">
                    <form action="{{route('events.update')}}" method="post">
                        {{ csrf_field() }}
                        <select class="form-select" id="eventList" name="event_id" aria-label="Default select example" required>
                        </select>
                        <div class="modal-footer">
                            <button type="button"
                                    onclick="book();"
                                    class="btn btn-primary buton" data-bs-toggle="modal"
                                    data-bs-target="#bookModal">Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <!-- Book Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Event Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('book.create')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label>Name</label>
                            <input type="text" class="form-control"  name="name" aria-describedby="basic-addon1" required>
                            <label>Mobil</label>
                            <input type="number" class="form-control"  name="mobil" aria-describedby="basic-addon1" required>
                            <label>email</label>
                            <input type="text" class="form-control"  name="email" aria-describedby="basic-addon1" required>
                            </br>
                            <input type="hidden" id="eventId" name="event_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>


        function getEvents() {
            let day =   document.getElementById('daySelect').value;
            $.ajax({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'events/all',
                type: 'get',
                data: {day: day},
                success: function (data) {



                    if(data.status == 200){
                        var events = data.events;
                        let option = '';
                        events.forEach(function(event) {
                            console.log(event.movie)
                            option += `<option value="${event.id}" >${event.movie.name} ${formatTime(event.showtime.from)}/${formatTime(event.showtime.to)}</option>`;
                        });
                        document.getElementById('eventList').innerHTML = option;
                        document.getElementById('massDev').style.display = 'none';
                        document.getElementById('eventsDev').style.display = 'block';
                    }else{
                        document.getElementById('massDev').style.display = 'block';
                        document.getElementById('eventsDev').style.display = 'none';
                    }


                }
            });
        }


        function book() {

            document.getElementById('eventId').value = document.getElementById('eventList').value;
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
