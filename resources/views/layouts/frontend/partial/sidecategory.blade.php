@php
    $categories=App\Models\Category::orderBy('category_name_en','ASC')->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">
        @foreach ($categories as $category)

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{$category->category_icon}}" aria-hidden="true"></i>
          @if(session()->get('language') == 'bangla') {{$category->category_name_bn}} @else {{$category->category_name_en}} @endif
        </a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
              {{-- get subcategory table data show --}}
              @php
              $subcategories=App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
              @endphp
              @foreach ($subcategories as $scategory)
                <div class="col-sm-12 col-md-3">
                  <a href="{{url('category/product/'.$scategory->id.'/'.$scategory->subcategory_name_en)}}">
                  <h2>
                    @if(session()->get('language') == 'bangla')
                     {{$scategory->subcategory_name_bn}}
                      @else {{$scategory->subcategory_name_en}}
                       @endif 
                  </h2>
                </a>
                       {{-- get sub subcategory table data show --}}
                       @php
                       $subsubcategories=App\Models\SubSubCategory::where('subcategory_id',$scategory->id)->orderBy('sub_subcategory_name_en','ASC')->get();
                       @endphp
                         @foreach ($subsubcategories as $sub_scategory)
                  <ul class="links list-unstyled">
                    <li><a href="{{url('subcategory/product/'.$sub_scategory->id.'/'.$sub_scategory->sub_subcategory_name_en)}}">
                      @if(session()->get('language') == 'bangla') {{$sub_scategory->sub_subcategory_name_bn}} @else {{$sub_scategory->sub_subcategory_name_en}} @endif
                    </a></li>
                  </ul>
                  @endforeach <!---------sub subcategory foreach loopp ------>
                </div>
                <!-- /.col -->
                @endforeach <!---------subcategory foreach loopp ------>
              </div>
              <!-- /.row --> 
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
            
          @endforeach <!------category foreach --------->

      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>