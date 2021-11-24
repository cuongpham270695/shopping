@extends('layouts.admin')
@section('title','Home')
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Add', 'key' => 'Category'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('categories.store')}}" method="post">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Category name:</label>
                                <br>
                                <label>
                                    <input type="text" name="name" class="form-control" placeholder="Fill category's name">
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">Select parent option</option>
                                        {!! $htmlOption !!}
                                    </select>
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
