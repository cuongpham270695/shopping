@extends('layouts.admin')
@section('title','Home')
@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/create/create.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Add', 'key' => 'Slider'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Slider name:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Fill menu's name" value="{{old('name')}}">
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
                                              placeholder="Fill description">{{old('description')}}</textarea>
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
