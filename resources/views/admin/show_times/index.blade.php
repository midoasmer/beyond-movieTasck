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
                Create New Time
            </button>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">From</th>
                    <th scope="col">TO</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                @endphp
                @foreach($showTimes as $key => $time)
                    <tr>
                        <td>{{$time->id}}</td>
                        <td>{{$time->from->format('g:i A')}}</td>
                        <td>{{$time->to->format('g:i A')}}</td>
                        <td>
                            @if ($time->status == 1)
                                <span class="text-success"> Active </span>
                            @else
                                <span class="text-danger">Unactive</span>
                            @endif
{{--                                <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                    <input type="checkbox" onchange="" checked="">--}}
{{--                                    <span class="slider round"></span>--}}
{{--                                </label>--}}
                        </td>
                        <td>

                            <button type="button" onclick="update(<?php echo htmlspecialchars(json_encode($time)) ?>);" class="btn btn-warning buton" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="remove(<?php echo htmlspecialchars(json_encode($time->id)) ?>);" class="btn btn-danger buton" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                    <h5 class="modal-title" id="exampleModalLabel">Creat New Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('show_times.create')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                           <label>From</label>
                            <input type="time" name="from" required>
                            <label>To</label>
                            <input type="time" name="to" required></br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Showtime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('show_times.update')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label>From</label>
                            <input type="time" name="from" id="updateFrom" required>
                            <label>To</label>
                            <input type="time" name="to" id="updateTo" required></br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Showtime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('show_times.delete')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            Are You Sure You Will Delete Showtime?
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

        function update(showtime) {

            document.getElementById('updateFrom').value = showtime.from;
            document.getElementById('updateTo').value = showtime.to;
            document.getElementById('updateStatus').checked = showtime.status;
            document.getElementById('updateId').value = showtime.id;
        }

        function remove(id) {
            document.getElementById('deleteId').value = id;
        }

    </script>

@endsection
