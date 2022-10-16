@extends('layouts.backend.app')

@section('title','Subscription')
@push('css')
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endpush
@section('content')
    
<div class="container-fluid">


    <div class="row clearfix">
        <div class="col-xs-12 col-sm-9">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            {{-- <li role="presentation" class=""><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Home</a></li> --}}
                            <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true">Profile</a></li>
                            <li role="presentation" class=""><a href="#update_profile" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"> Update-Profiles</a></li>
                            <li role="presentation" class=""><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Change Password</a></li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane fade active in" id="profile_settings">
                                <div class="card">
                                    <div class="card-header bg-primary"style="padding:0 13px"><h2>Admin Profile</h2>    
                                        </div>
                                    <div class="card-body"style="padding:12px">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <img src="{{(!empty($adminprofile->image))? url('storage/profile/'.$adminprofile->image): url('storage/defaul.png')}}" alt="Image"width="200px"height="200px"style="    border-radius: 100px;">
                                  
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <h4>Name: {{$adminprofile->name}}</h4>
                                            <h5>E-mail: {{$adminprofile->email}}</h5>
                                            <h5>Phone: {{$adminprofile->username}}</h5>
                                            <h5>Bio-data: {{$adminprofile->about}}</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="update_profile">
                                <form class="form-horizontal"action="{{route('profile.store')}}"method="POST"enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <div class="form-line focused">
                                                <input type="text" class="form-control" id="NameSurname" name="name" placeholder="Name Surname" value="{{$adminprofile->name}}" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="Email" name="email" placeholder="Email" value="{{$adminprofile->email}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Image" class="col-sm-2 control-label">Profile Image</label>

                                        <div class="col-sm-10">
                <div class="form-line">
                    <input type="file" class="form-control" id="image" name="image" placeholder="Skills">
                    <img id="showImage"src="{{(!empty($adminprofile->image))? url('storage/profile/'.$adminprofile->image): url('/storage/defaul.png')}}" alt="Image"width="50px"height="50px"style="    border-radius: 100px;">

                    
                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputExperience" class="col-sm-2 control-label">About</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <textarea class="form-control" id="InputExperience" name="about" rows="3" placeholder="Experience">{{$adminprofile->about}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                  

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="change_password_settings">
                                {{-- <form class="form-horizontal"action="{{route('change.password')}}"method="post">
                                    @csrf
                                  
                                    <div class="form-group">
                                        <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line focused">
                                                <input type="password" class="form-control" id="OldPassword" name="oldassword" placeholder="Old Password" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPassword" name="password" placeholder="New Password" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPasswordConfirm" name="password_confirmation" placeholder="New Password (Confirm)" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection
@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deleteSub(id){
             
                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                      event.preventDefault();
                      document.getElementById('delete-form-'+id).submit();
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Data  is safe :)',
                        'error'
                        )
                    }
                    })
        }
 </script>
 <script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
 </script>
@endpush