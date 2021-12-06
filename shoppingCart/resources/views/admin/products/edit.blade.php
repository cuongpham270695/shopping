@extends('layouts.admin')
@section('title','Edit product')
@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/create/create.css')}}" rel="stylesheet">

@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Edit', 'key' => 'Product'])
        <form action="{{route('products.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
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
                                           placeholder="Fill product's name" value="{{$product->name}}">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product price:</label>
                                <br>
                                <label>
                                    <input type="text" name="price" class="form-control"
                                           placeholder="Fill product's price" value="{{$product->price}}">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Avatar:</label>
                                <br>
                                <input type="file" name="image" class="form-control-file">
                                <div class="col-md-4 container_feature_image">
                                    <div class="row">
                                        <img class="feature_image" src="{{$product->image}}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Images detail:</label>
                                <br>
                                <label>
                                    <input type="file" name="images[]" class="form-control-file">
                                </label>
                                <div class="col-md-12 container_image_detail">
                                    <div class="row">
                                        @foreach($product->productImages as $productImageItem)
                                            <div class="col-md-3">
                                                <img class="image_detail" src="{{$productImageItem->images}}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>
                                    <select class="form-control select2-init" name="category_id">
                                        <option value="">Select category</option>
                                        {!! $htmlOption !!}
                                    </select>
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tags for product</label>
                                <select class="form-control tags-select" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control tinymce_editor_init" rows="8">
                                    {{$product->description}}
                                </textarea>
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

