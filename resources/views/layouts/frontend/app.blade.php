<!DOCTYPE html>
<html lang="en">
<head>
   <title> @yield('title')</title>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="author" content="">
<meta name="keywords" content="Mfcoder, freelancer farahd, md farahd, ecommerce,">
<meta name="robots" content="all">

@include('layouts.frontend.partial.style')

@yield('styles')
</head>
<body class="cnt-home">

<!-- ============================================== HEADER ======================== -->
@include('layouts.frontend.partial.header')
<!-- =============================================== HEADER : END ======================== -->
@yield('content')
<!-- ============================================== FOOTER ================== -->
@include('layouts.frontend.partial.footer')
<!-- ============================================== FOOTER : END================= --> 

@include('layouts.frontend.partial.script')

@yield('scripts')


<!-- Product Modal -->

<!-- Add to Cart Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span> </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"id="closeModal">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
 
       <div class="modal-body">
 
        <div class="row">
 
         <div class="col-md-4">
 
             <div class="card" style="width: 18rem;">
               <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;" id="pimage">
             </div>
 
         </div><!-- // end col md -->
 
 
         <div class="col-md-4">
 
      <ul class="list-group">
       <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="pprice"></span></strong>  <del id="oldprice"> </del> </li>
       <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
       <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
       <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
       <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"id="abiable"style="background:green;color:white;"></span><span class="badge badge-pill badge-danger"id="stockout"style="background:red;color:white;"></span></li>
 </ul>
 
         </div><!-- // end col md -->
 
 
         <div class="col-md-4">
 
             <div class="form-group"id="colorArea">
               <label for="color">Choose Color</label>
                <select class="form-control" id="color"name="color">
                  
                </select>
              </div> <!----color end---->

              <div class="form-group"id="sizeArea">
                <label for="size">Choose Size</label>
                 <select class="form-control" id="size"name="size">
             
                 </select>
               </div><!----size end----->

               <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number"class="form-control"min="1"id="qty"value="1">
               </div><!----size end----->

               <div class="form-group">
                <input type="hidden" id="product_id">
                <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()" >Add to Cart</button>
               </div><!----submit end----->
 
         </div><!-- // end col md -->
 
 
        </div> <!-- // end row -->
 
 
       </div> <!-- // end modal Body -->
 
     </div>
   </div>
 </div>
 <!-- End Add to Cart Product Modal -->
 
  <!-- Product Modal End-->
 
 
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    //product get data
    function productView(id){
    // alert(id)
    $.ajax({
        type: 'GET',
        url: '/product/view/modal/'+id,
        dataType:'json',
        success:function(data){
                 // console.log(data)
           $('#pname').text(data.product.product_name_en);
           $('#price').text(data.product.selling_price);
           $('#pcode').text(data.product.product_code);
           $('#pcategory').text(data.product.category.category_name_en);
           $('#pbrand').text(data.product.brand.banner_name_en);
           $('#pimage').attr('src','/storage/product/'+data.product.product_thumbnail);
           $('#product_id').val(id);
            $('#qty').val(1);
           //price
           if(data.product.discount_price == null){
            $('#pprice').text("");
            $('#oldprice').text("");
            $('#pprice').text(data.product.selling_price);
           }else{
            $('#pprice').text(data.product.discount_price);
            $('#oldprice').text(data.product.selling_price);
           }//end price

            // Color
          $('select[name="color"]').empty();        
          $.each(data.color,function(key,value){
              $('select[name="color"]').append('<option value=" '+value+' ">'+value+' </option>')

              if(data.color==""){
                $('#colorArea').hide();
              }else{
                $('#colorArea').show();
              }//end if
          }) // end color

           // Size
           $('select[name="size"]').empty();        
          $.each(data.size,function(key,value){
              $('select[name="size"]').append('<option value=" '+value+' ">'+value+' </option>')

              if(data.size==""){
                $('#sizeArea').hide();
              }else{
                $('#sizeArea').show();
              }//end if
          }) // end Size 

          //stock manage
          if(data.product.product_qty > 0){
            $('#abiable').text('');
            $('#stockout').text('');
            $('#abiable').text("Abiabile");
          }else{
            $('#abiable').text('');
            $('#stockout').text('');
            $('#stockout').text("Stockout");
          }//end stock

       }
   }) 
 }
   //End product get data

   //cart start
   function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                color:color, size:size, quantity:quantity, product_name:product_name
            },
            url: "/cart/data/store/"+id,
            success:function(data){
              miniCart()
              $('#closeModal').click();
                // console.log(data)

                  // Start Message 
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        })
    }

   //End cart 
 

</script>
 <script>
   //mini cart start
   function miniCart(){
    $.ajax({
      type: 'GET',
      url: "/product/mini/cart/",
      dataType: 'json',
      success: function(response){
        // console.log(response)
        $('span[id="cartSubTotal"]').text(response.cartTotal);
        $('#cartQty').text(response.cartQty);
        var miniCart = ""
        $.each(response.carts, function(key,value){
                    miniCart += `<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/storage/product/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                      <div class="price">${value.price} * ${value.qty}</div>
                    </div>
                    <div class="col-xs-1 action"> 
                      <button type="submit"id="${value.rowId}"onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                       </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`
                });
        $('#miniCart').html(miniCart);
      }
    })
   }
   miniCart();

  /// mini cart remove Start 
  function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
            miniCart();
            Cart();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
 //  end mini cart remove 

 </script>
   <!-- Wish List Script-->
   <script>
      function addToWishList(product_id){
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: '/add-wist-list/'+product_id,
          success: function(data){
                  // Start Message 
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                      icon: 'success',
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                      icon: 'error',
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
          }
        })
      }
   </script>
   <!-- End Wish List Script-->
<!-------wishlist show------->


<!--  /// End Add Wishlist Page  ////   -->

<!-- /// Load Wishlist Data  -->


<script type="text/javascript">
    function wishlist(){
       $.ajax({
           type: 'GET',
           url: "/user/get-wishlist-product",
           dataType:'json',
           success:function(response){
               var rows = ""
               $.each(response, function(key,value){
                   rows += `<tr>
                   <td class="col-md-2"><img src="/storage/product/${value.product.product_thumbnail} " alt="imga"></td>
                   <td class="col-md-7">
                       <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
                        
                       <div class="price">
                       ${value.product.discount_price == null
                           ? `${value.product.selling_price}`
                           :
                           `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                       }
                           
                       </div>
                   </td>
                   <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
        </td>
        <td class="col-md-1 close-btn">
             <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
      
        </td>
               </tr>`
       });
               
               $('#wishlist').html(rows);
           }
       })
    }
wishlist();
</script> 
<script>
    ///  Wishlist remove Start 
    function wishlistRemove(id){
        $.ajax({
            type: 'GET',
            url: '/user/wishlist-remove/'+id,
            dataType:'json',
            success:function(data){
            wishlist();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
 // End Wishlist remove   
 </script> 



<!------cart page ajax------>


<script type="text/javascript">
  function Cart(){
     $.ajax({
         type: 'GET',
         url: "/user/get-cart-product",
         dataType:'json',
         success:function(response){
             var rows = ""
             $.each(response.carts, function(key,value){
                 rows += `<tr>
                 <td class="col-md-2">
                   <img src="/storage/product/${value.options.image} " alt="imga"style="width:60px;height:60px">
                 </td>

                 <td class="col-md-7">
                    <div class="product-name"><a href="#">${value.name}</a></div>
                 </td>

                 <td>
                 <div class="price">$${value.price}</div>
                  </td>

                  <td class="col-md-7">
                  ${value.options.color == null
                    ?`<span>...</span>`
                    :
                     `
                     ${value.options.color}`
                  }
                 
                   </td>

                 <td>
                 ${value.options.size ==null
                    ?`<span>...</span>`
                    :
                    `${value.options.size}`
                    }
                 </td>

                 <td><div class="quantity"style="display:inline-flex;">
                 ${value.qty >1
                    ?
                    `   <button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> `
                    :
                    `   <button type="submit" class="btn btn-danger btn-sm"  disabled="" >-</button> `
                 }
              
                <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" >  
                <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>    
         
                  </div>
                  </td>
                <td>$${value.subtotal}</td>

                 <td class="col-md-1 close-btn">
                    <button type="submit" class="btn btn-danger" id="${value.rowId}" onclick="CartRemove(this.id)"><i class="fa fa-times"></i></button>
                 </td>
             </tr>`
     });
             
             $('#cartPage').html(rows);
         }
     })
  }
Cart();
</script> 

<script>
  ///  Wishlist remove Start 
  function CartRemove(id){
      $.ajax({
          type: 'GET',
          url: '/user/cart-remove/'+id,
          dataType:'json',
          success:function(data){
            couponCalculation();
          Cart();
          miniCart();
          $('#couponField').show();
             $('#coupon_name').val('');
           // Start Message 
              const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    
                    showConfirmButton: false,
                    timer: 3000
                  })
              if ($.isEmptyObject(data.error)) {
                  Toast.fire({
                      type: 'success',
                      icon: 'success',
                      title: data.success
                  })
              }else{
                  Toast.fire({
                      type: 'error',
                      icon: 'error',
                      title: data.error
                  })
              }
              // End Message 
          }
      });
  }
// End Wishlist remove   
</script> 


<!------End Cart------>
<script type="text/javascript">
     // -------- CART INCREMENT --------//
    function cartIncrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-increment/"+rowId,
            dataType:'json',
            success:function(data){
                   Cart();
                    miniCart();
                    couponCalculation();
            }
        });
    }
 // ---------- END CART INCREMENT -----///

      // -------- CART DECREMENT --------//
    function cartDecrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-decrement/"+rowId,
            dataType:'json',
            success:function(data){
                   Cart();
                    miniCart();
                    couponCalculation();
            }
        });
    }
 // ---------- END CART DECREMENT -----///
</script>

<!-----coupon apply--------->

<script>
  function applyCoupon(){
    var coupon_name = $('#coupon_name').val();
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data:{coupon_name:coupon_name},
      url:"{{url('/coupon-apply')}}",
      success:function(data){
        couponCalculation();
        if(data.validity == true){
          $('#couponField').hide();
        }
      
    // Start Message 
    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    
                    showConfirmButton: false,
                    timer: 3000
                  })
              if ($.isEmptyObject(data.error)) {
                  Toast.fire({
                      type: 'success',
                      icon: 'success',
                      title: data.success
                  })
              }else{
                  Toast.fire({
                      type: 'error',
                      icon: 'error',
                      title: data.error
                  })
              }
              // End Message 
      }
    })
  }


  function couponCalculation(){
    $.ajax({
        type: 'GET',
        url: "{{ url('/coupon-calculation') }}",
        dataType: 'json',
        success:function(data){
          if(data.total){
                $('#couponCalField').html(
            `	<tr>
            <th>
              <div class="cart-sub-total">
                Subtotal<span class="inner-left-md">$ ${data.total}</span>
              </div>
              <div class="cart-grand-total">
                Grand Total<span class="inner-left-md">$ ${data.total}</span>
              </div>
            </th>
          </tr>`
          )
          }else{
         $('#couponCalField').html(
            `	<tr>
            <th>
              <div class="cart-sub-total">
                Subtotal<span class="inner-left-md">       $${data.subtotal}</span>
              </div>
              <div class="cart-sub-total">
                Coupon Nm<span class="inner-left-md"> ${data.cupon_name}</span>
                <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
              </div>
              <div class="cart-sub-total">
                Discount <span class="inner-left-md">$${data.discount_amount}</span>
              </div>
              <div class="cart-grand-total">
                Grand Total    <span class="inner-left-md">     $${data.total_amount}</span>
              </div>
            </th>
          </tr>`
          )
          }
        }
    })
  }
  couponCalculation();
</script>

<!-----end coupon apply--------->

<!--  //////////////// =========== Start Coupon Remove================= ////  -->

<script type="text/javascript">
     
  function couponRemove(){
     $.ajax({
         type:'GET',
         url: "{{ url('/coupon-remove') }}",
         dataType: 'json',
         success:function(data){
             couponCalculation();
             $('#couponField').show();
             $('#coupon_name').val('');
              // Start Message 
             const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   
                   showConfirmButton: false,
                   timer: 3000
                 })
             if ($.isEmptyObject(data.error)) {
                 Toast.fire({
                     type: 'success',
                     icon: 'success',
                     title: data.success
                 })
             }else{
                 Toast.fire({
                     type: 'error',
                     icon: 'error',
                     title: data.error
                 })
             }
             // End Message 
<!--  //////////////// =========== End Coupon Apply Start ================= ////  -->
         }
     });
  }
</script>


<!--  //////////////// =========== End Coupon Remove================= ////  -->

</body>
</html>