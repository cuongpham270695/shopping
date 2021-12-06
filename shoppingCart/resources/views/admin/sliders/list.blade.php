@extends('layouts.admin')
@section('title','Home')

@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/list/list.css')}}">
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('admins/slider/list/list.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['name' => 'Slider', 'key' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Create</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Slider name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $key => $slider)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$slider->name}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img class="image_slider" src="{{$slider->image_path}}" alt=""></td>
                                    <td>
                                        <a href="{{route('sliders.edit',['id'=>$slider->id])}}"
                                           class="btn btn-primary">Edit</a>
                                        <a class="btn btn-danger action_delete"
                                           data-url="{{route('sliders.destroy',['id'=>$slider->id])}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$sliders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
