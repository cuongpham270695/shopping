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
                                <label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Fill product's name">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product price:</label>
                                <br>
                                <label>
                                    <input type="text" name="price" class="form-control"
                                           placeholder="Fill product's price">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Avatar:</label>
                                <br>
                                <label>
                                    <input type="file" name="image" class="form-control-file">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Images detail:</label>
                                <br>
                                <label>
                                    <input type="file" name="images[]" class="form-control-file">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>
                                    <select class="form-control select2-init" name="parent_id">
                                        <option value="">Select category</option>
                                        {!! $htmlOption !!}
                                    </select>
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
                                <textarea name="description" class="form-control tinymce_editor_init" rows="8"></textarea>
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
