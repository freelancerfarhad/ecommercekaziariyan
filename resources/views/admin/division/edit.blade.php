@extends('layouts.backend.app')
@section('title','Division')
    
@push('css')
    
@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Division EDIT
                            <small>Division Edit label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('division.update',$division->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="ship_division_name" class="form-control"name="ship_division_name"value="{{$division->ship_division_name}}">
                                    <label class="form-label"for="ship_division_name">Division Name</label>
                                </div>
                            </div>
                            <br>
                            <a href="{{route('division.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Division</button>
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