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
                Create New Movie
            </button>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                @endphp
                @foreach($movies as $key => $movie)
                    <tr>
                        <td>{{$movie->id}}</td>
                        <td>{{$movie->name}}</td>
                        <td>
                            @if ($movie->status == 1)
                                <span class="text-success"> Active </span>
                            @else
                                <span class="text-danger">Unactive</span>
                            @endif
                        </td>
                        <td>

                            <button type="button" onclick="update(<?php echo htmlspecialchars(json_encode($movie)) ?>);" class="btn btn-warning buton" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="remove(<?php echo htmlspecialchars(json_encode($movie->id)) ?>);" class="btn btn-danger buton" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                    <h5 class="modal-title" id="exampleModalLabel">Creat New Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('movies.create')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                           <label>Movie Name</label>
                            <input type="text" name="name" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('movies.update')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label>Movie Name</label>
                            <input type="text" name="name" id="updateName" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('movies.delete')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            Are You Sure You Will Delete Movie?
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

        function update(movie) {
            document.getElementById('updateName').value = movie.name;
            document.getElementById('updateStatus').checked = movie.status;
            document.getElementById('updateId').value = movie.id;
        }

        function remove(id) {
            document.getElementById('deleteId').value = id;
        }

    </script>

@endsection
