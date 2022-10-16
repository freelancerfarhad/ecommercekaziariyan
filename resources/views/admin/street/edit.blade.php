@extends('layouts.backend.app')
@section('title','State')
    
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
                            State ADDED
                            <small>State Added label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('street.update',$state->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="division_id" id="division_id"class="form-control">
                                        <option value=""selected=""disabled>Select Division</option>
                                        @foreach ($division as $division)
                                        <option value="{{$division->id}}"{{$division->id == $state->division_id ? 'selected':''}}>{{$division->ship_division_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="district_id" id="district_id"class="form-control">
                                        <option value=""selected=""disabled>Select District</option>
                                        @foreach ($district as $district)
                                        <option value="{{$district->id}}"{{$district->id == $state->district_id ? 'selected':''}}>{{$district->district_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                
                            
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="street_name" class="form-control"name="street_name"value="{{$state->street_name}}">
                              
                                </div>
                            </div>
                            <br>
                            <a href="{{route('street.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">State Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="division_id"]').on('change', function(){
          var division_id = $(this).val();
        //   alert(category_id);
          if(division_id) {
              $.ajax({
                  url: "{{  url('/admin/street/ajax') }}/"+division_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                     var d =$('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
</script>
@endpush