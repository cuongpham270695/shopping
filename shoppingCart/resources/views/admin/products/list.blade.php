@extends('layouts.admin')
@section('title','Home')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['name' => 'Product', 'key' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
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
{{--                            @foreach($categories as $key => $category)--}}
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Iphone X</td>
                                    <td>5.000.000d</td>
                                    <td>
                                        <img src="" alt="">
                                    </td>
                                    <td>Phone</td>
                                    <td>
                                        <a href=""
                                           class="btn btn-primary">Edit</a>
                                        <a href=""
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure to delete this category ?')">Delete</a>
                                    </td>
                                </tr>
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
{{--                    <div class="col-md-12">--}}
{{--                        {{$categories->links()}}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
