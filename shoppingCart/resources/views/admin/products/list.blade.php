@extends('layouts.admin')
@section('title','Home')
@section('css')
    <link rel="stylesheet" href="{{asset('admins/product/list/list.css')}}">
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('admins/product/list/list.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['name' => 'Product', 'key' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn btn-success float-right m-2">Create</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td>
                                        <img class="product_image" src="{{$product->image}}" alt="">
                                    </td>
                                    <td>
                                        @if(empty($product->category->id))
                                            <p>Don't have category</p>
                                        @else
                                            {{$product->category->name}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('products.edit',['id' => $product->id])}}"
                                           class="btn btn-primary">Edit</a>
                                        <a href=""
                                           data-url="{{route('products.destroy',['id'=> $product->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
