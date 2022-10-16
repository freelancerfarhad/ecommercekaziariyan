@extends('layouts.backend.app')
@section('title','District')
    
@push('css')
     <!-- Bootstrap Select Css -->
     <link href="{{asset('assets/backend')}}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            District EDIT
                            <small>District Edit label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('district.update',$district->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="division_id" id="division_id"class="form-control">
                                        <option value=""selected=""disabled>Select Division</option>
                                        @foreach ($division as $division)
                                        <option value="{{$division->id}}" {{$division->id == $district->division_id ? 'selected':''}}>{{$division->ship_division_name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label"for="category_id"> Division Selected</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="district_name" class="form-control"name="district_name"value="{{$district->district_name}}">
                                    <label class="form-label"for="district_name"> District Name </label>
                                </div>
                            </div>
                            <br>
                            <a href="{{route('district.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update District</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
    
@endpush