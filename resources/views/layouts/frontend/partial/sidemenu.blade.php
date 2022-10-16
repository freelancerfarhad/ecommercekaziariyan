<div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
        
  <!-- ================================== TOP NAVIGATION ================================== -->
 @include('layouts.frontend.partial.sidecategory')
  <!-- /.side-menu --> 
  <!-- ================================== TOP NAVIGATION : END ================================== --> 
  
  <!-- ============================================== HOT DEALS ============================================== -->
  @include('layouts.frontend.common.hotdeals')
  <!-- ============================================== HOT DEALS: END ============================================== --> 
  
  <!-- ============================================== SPECIAL OFFER ============================================== -->
  
  <div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla') বিশেষ প্রস্তাব @else Special Offer @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
      <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
       
        <div class="item">
          <div class="products special-product">
        @foreach ($specialoffers as $specialoffers)
            <div class="product">
              <div class="product-micro">
                <div class="row product-micro-row">
                  <div class="col col-xs-5">
                    <div class="product-image">
                      <div class="image"> <a href="{{url('product/details/'.$specialoffers->id.'/'.$specialoffers->product_slug_en)}}"><img  src="{{asset('storage/product/'.$specialoffers->product_thumbnail)}}" alt=""></a> </div>
                      <!-- /.image --> 
                      
                    </div>
                    <!-- /.product-image --> 
                  </div>
                  <!-- /.col -->
                  <div class="col col-xs-7">
                    <div class="product-info">
                      <h3 class="name">  <a href="{{url('product/details/'.$specialoffers->id.'/'.$specialoffers->product_slug_en)}}">
                        @if(session()->get('language') == 'bangla') {{ Str::limit($specialoffers->product_name_bn,25)}} @else {{ Str::limit($specialoffers->product_name_en,25)}} @endif
                      </a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="product-price">   
                           @if ($specialoffers->discount_price == NULL)
                        <span class="price"> ${{$specialoffers->selling_price}} </span> 
                        @else
                        <span class="price"> ${{$specialoffers->discount_price}} </span> 
                        <span class="price-before-discount">${{$specialoffers->selling_price}}</span>
                        @endif </div>
                      <!-- /.product-price --> 
                      
                    </div>
                  </div>
                  <!-- /.col --> 
                </div>
                <!-- /.product-micro-row --> 
              </div>
              <!-- /.product-micro --> 
            </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 
  <!-- ========================= SPECIAL OFFER : END ======================= --> 
  <!-- ================== PRODUCT TAGS ================== -->
  @include('layouts.frontend.common.productTags')
  <!-- ============= PRODUCT TAGS : END =================== --> 
  <!-- ==================== SPECIAL DEALS ======================= -->
  
  <div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla') বিশেষ চুক্তি @else Special Deals @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
      <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
        <div class="item">
          <div class="products special-product">
            @foreach ($specialdeals as $specialdeal)
            <div class="product">
              <div class="product-micro">
                <div class="row product-micro-row">
                  <div class="col col-xs-5">
                    <div class="product-image">
                      <div class="image"> <a href="{{url('product/details/'.$specialdeal->id.'/'.$specialdeal->product_slug_en)}}"><img  src="{{asset('storage/product/'.$specialdeal->product_thumbnail)}}" alt=""></a> </div> <!-- /.image --> 
                    </div><!-- /.product-image --> 
                  </div>  <!-- /.col -->
                  <div class="col col-xs-7">
                    <div class="product-info">
                      <h3 class="name"><a href="{{url('product/details/'.$specialdeal->id.'/'.$specialdeal->product_slug_en)}}">
                        @if(session()->get('language') == 'bangla') {{ Str::limit($specialdeal->product_name_bn,25)}} @else {{ Str::limit($specialdeal->product_name_en,25)}} @endif
                      </a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="product-price"> 
                        {{-- @if ($specialdeal->discount_price == NULL) --}}
                        <span class="price"> ${{$specialdeal->selling_price}} </span> 
                        {{-- @else
                        <span class="price"> ${{$specialdeal->discount_price}} </span> 
                        <span class="price-before-discount">${{$specialdeal->selling_price}}</span>
                        @endif  --}}
                      </div><!-- /.product-price --> 
                    </div>
                  </div>     <!-- /.col --> 
                </div>   <!-- /.product-micro-row --> 
              </div> <!-- /.product-micro --> 
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 
  <!-- ============================================== SPECIAL DEALS : END ============================================== --> 
  <!-- ============================================== NEWSLETTER ============================================== -->
  <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
      <p>Sign Up for Our Newsletter!</p>
      <form>
        <div class="form-group">
          <label class="sr-only" for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
        </div>
        <button class="btn btn-primary">Subscribe</button>
      </form>
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 
  <!-- ============================================== NEWSLETTER: END ============================================== --> 
  
  <!-- ============================================== Testimonials============================================== -->
 @include('layouts.frontend.common.testimonial')
  <!-- ============================================== Testimonials: END ============================================== -->
  
  <div class="home-banner"> <img src="{{asset('assets/frontend')}}/assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
</div>