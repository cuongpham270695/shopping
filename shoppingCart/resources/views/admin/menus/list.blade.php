@extends('layouts.admin')
@section('title','Home')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['name' => 'Menu', 'key' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $key => $menu)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$menu->name}}</td>
                                    <td>
                                        <a href="{{route('menus.edit',['id'=>$menu->id])}}"
                                           class="btn btn-primary">Edit</a>
                                        <a href="{{route('menus.destroy',['id'=>$menu->id])}}"
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure to delete that ?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                                        <div class="col-md-12">
                                            {{$menus->links()}}
                                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
