@extends('layouts.admin')
@section('title','Home')
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Add', 'key' => 'Menu'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Menu name:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Fill menu's name">
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Select parent option:</label>
                                <br>
                                <label class="form-group col-md-6">
                                    <select class="form-control" name="parent_id">
                                        <option value="0">Select parent option</option>
                                        {!! $optionSelect !!}
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
