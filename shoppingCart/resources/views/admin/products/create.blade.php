@extends('layouts.admin')
@section('title','Add product')
@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/create/create.css')}}" rel="stylesheet">

@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Add', 'key' => 'Product'])
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label>Product name:</label>
                                <br>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Fill product's name" value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger fix_css">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product price:</label>
                                <br>
                                <input type="text" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="Fill product's price" value="{{old('price')}}">
                                @error('price')
                                <div class="alert alert-danger fix_css">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Avatar:</label>
                                <br>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Images detail:</label>
                                <br>
                                <input type="file" name="images[]" class="form-control-file">
                            </div>

                            <div class="form-group col-md-6">
                                <label>
                                    <select class="form-control select2-init @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                        <option value="">Select category</option>
                                        {!! $htmlOption !!}
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger fix_css">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tags for product</label>
                                <select class="form-control tags-select" name="tags[]" multiple="multiple">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                          class="form-control tinymce_editor_init @error('description') is-invalid @enderror"
                                          rows="8">
                                    {{old('description')}}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger fix_css">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{asset('admins/product/create/create.js')}}"></script>
@endsection
