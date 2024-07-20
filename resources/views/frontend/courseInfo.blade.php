@extends('layouts.minapp')

@section('content')
    <div class="container single-product">
        <div class="row">
            <div class="col-6  animate__animated animate__bounceInLeft">
                <div class="single-img">
                    <img src="{{$course->photo_link ? asset('Courses/'.$course->photo_link):'http://placehold.it/50x50'}}" width="100%" height="100%" id="productImg">
                </div>
            </div>
            <div class="col-6  animate__animated animate__bounceInRight">
                <h2>{{$course->name}}</h2>
                <h3>{{$course->hours}}H</h3>
{{--                <select>--}}
{{--                    <option>Select Size</option>--}}
{{--                    <option>XXL</option>--}}
{{--                    <option>XL</option>--}}
{{--                    <option>LARGE</option>--}}
{{--                    <option>MEDIUM</option>--}}
{{--                    <option>SMALL</option>--}}
{{--                </select>--}}


                <h4>Course details</h4>
                <p>{{$course->description}}</p>
                <div class="end">
                    <a href="#"><i class="fas fa-heart like"></i></a>
                    <a href="#"><i class="fas fa-shopping-cart like2"></i></a>
                </div>


            </div>
        </div>
    </div>
@endsection
