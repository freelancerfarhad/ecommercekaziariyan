<div class="card">
    <div class="card-header bg-primary"style="padding:0 13px"><h2>Admin Profile</h2>
         <a href="{{route('admin.edit')}}"style="float:right" class="btn btn-sm btn-primary">Edit-Profile</a>
        </div>
    <div class="card-body"style="padding:12px">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <img src="{{(!empty($adminprofile->image))? url('storage/profile'.$adminprofile->image): url('storage/defaul.png')}}" alt="Image"width="200px"height="200px"style="    border-radius: 100px;">
  
        </div>
        <div class="col-sm-12 col-md-6">
            <h4>Name: {{$adminprofile->name}}</h4>
            <h5>E-mail: {{$adminprofile->email}}</h5>
            <h5>Phone: {{$adminprofile->username}}</h5>
        </div>
    </div>
    </div>
</div>