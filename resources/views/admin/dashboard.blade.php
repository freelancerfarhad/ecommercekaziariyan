@extends('layouts.backend.app')
@section('title','Dashboard')
@push('css')
    
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTS</div>
                    <div class="number count-to" data-from="0" data-to="55" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL FAVORITE</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text">PANDING POSTS</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">VIEW</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>

       <!-- Widgets -->
       <div class="row clearfix">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">apps</i>
                </div>
                <div class="content">
                    <div class="text">CATEGORIES</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">labels</i>
                </div>
                <div class="content">
                    <div class="text">Tags</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-blue-grey hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <div class="content">
                    <div class="text">Author</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">fiber_new</i>
                </div>
                <div class="content">
                    <div class="text">Today Author</div>
                    <div class="number count-to" data-from="0" data-to="44" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Top Popular Posts</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($popular_post as $key=>$popular)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{Str::limit($popular->title,'15')}}</td>
                                            <td>{{$popular->user->name}}</td>
                                            <td>{{$popular->view_count}}</td>
                                            <td>{{$popular->favorite_to_user_count}}</td>
                                            <td>{{$popular->comments_count}}</td>
                                            <td>
                                                @if ($popular->status==true)
                                                    <span class="bg-green">Published</span>
                                                @else
                                                <span class="bg-red">Panding</span>
                                                
                                                @endif    
                                            </td>
                                            <td>
                                                <a href="{{route('post.favorite',$popular->slug)}}"class="btn btn-sm btn-primary"target="_blank">View</a>
                                            </td>
                                            

                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>

    </div>
    <!-- #END# Widgets -->


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>TASK INFOS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank List</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($active_author as $key=>$activeuser)
                                    
                         
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$activeuser->name}}</td>
                                    <td>{{$activeuser->posts_count}}</td>
                                    <td>{{$activeuser->comments_count}}</td>
                                    <td>{{$activeuser->favorite_posts_count}}</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
      
        <!-- #END# Browser Usage -->
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('assets/backend/js/pages/index.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('assets/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('assets/backend/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('assets/backend/"plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

@endpush
