@extends('layouts.admin')
@section('title','Home')
@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/create/create.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Edit', 'key' => 'Slider'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('sliders.update',['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Slider name:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Fill menu's name" value="{{$slider->name}}">
                                    @error('name')
                                    <div class="alert alert-danger css_slider">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Description:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                                              placeholder="Fill description">{{$slider->description}}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger css_slider">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Image:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <input type="file" name="image_path"
                                           class="form-control-file @error('image_path') is-invalid @enderror">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <img class="image_slider" src="{{$slider->image_path}}" alt="">
                                        </div>
                                    </div>
                                    @error('image_path')
                                    <div class="alert alert-danger css_slider">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
