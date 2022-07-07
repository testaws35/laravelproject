@extends('layouts.app1')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
    <h2 class="text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.products_show_head')</h2>
     
     </div>

</div>
<?php  if( isset($product)  &&  !isset($Failed)  ) { ?>
<div class="container" style="margin-top:-80px;">	
<div class="card" style="box-shadow: 5px 10px 18px #888888;">
	<div class="row">
	    
		<aside class="col-sm-5 border-right">
        <article class="gallery-wrap"> 
            <div class="img-big-wrap">
                <div> <a href="#">
                        @if($product->Photo)
                             <img  src="{{ $product->Photo }}">
                             @else 
                             <img  src="/images/frontend_images/product-default.png">
                         @endif
                            </a>
                  </div>
            </div> <!-- slider-product.// -->
        </article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
		    <a href="{{ route('products.index') }}" class="pull-right" title="Back to Products" style="margin-top:-35px;"><b style="font-size:10px;">Back to Products</b></a> 
        <article class="card-body p-5">
            
	            <h3 class="title mb-3" style="font-family: 'Sen', sans-serif;">{{ $product->ProductName }} </h3>

              <p class="price-detail-wrap"> 
                <span class="price h3 text-warning"> 
                  <span class="currency"><i class="fa fa-inr" aria-hidden="true"></i>
                      </span><span class="num" style="font-family: 'Sen', sans-serif;">{{ $product->Price }} </span>
                </span> 
                <!--<span>/per kg</span> -->
              </p> <!-- price-detail-wrap .// -->
              <dl class="item-property">
                  <dt style="font-family: 'Sen', sans-serif;">@lang('home.templefunc_edit_desc')</dt>
                <dd><p style="font-family: 'Sen', sans-serif;">{{ $product->Description }}</p></dd>
              </dl>
              <dl class="param param-feature">
                  <dt style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_phydetails_weight')</dt>
                <dd style="font-family: 'Sen', sans-serif;">{{ $product->Weight }}&nbsp;Grams</dd>
              </dl>  <!-- item-property-hor .// -->
              <dl class="param param-feature">
                  <dt style="font-family: 'Sen', sans-serif;">@lang('home.products_show_carat')</dt>
                <dd style="font-family: 'Sen', sans-serif;">{{ $product->Carats }}</dd>
              </dl>  <!-- item-property-hor .// -->
              <hr>

              <?php if (isset($seller)  ) { ?>
               <p style="font-family: 'Sen', sans-serif;color:#000;font-size:18px;font-weight:600px;"><b> @lang('home.products_show_seller_details'):</b></p>
              
              <p style="font-family: 'Sen', sans-serif;"> {{ $seller->Name }}  , <br> {{$seller->CompanyName}}, <br> {{$seller->seller_Mobile}}</p>
              <?php  }  ?>

              <!-- only if current user is the owner seller , Eidt and Delete can be shown -->
              <?php if ($seller->UserID == Auth::user()->id  ) { ?>
              <a  onclick="return myDelete();" href="{{ route('products.destroy',$product->ProductID) }}"   class="pull-right ml-5">
                <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
              </a>
              <a  onclick="return myEdit();"   href="{{ route('products.edit',$product->ProductID)  }}" class="pull-right ml-5">
                  <i class="fa fa-edit fa-2x" aria-hidden="true"></i>
              </a>

            <?php  } ?>
              <script>
                  function myDelete() {
                      if(!confirm("Are you sure you want to delete this product?"))
                      event.preventDefault();
                  }
                  function myEdit() {
                      if(!confirm("Are you sure you want to edit this product?"))
                      event.preventDefault();
                  }
              </script>
    
    
              {{-- <form id="delete-form" action="{{ route('products.destroy', $product) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                </form>  --}}

            </article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->
<?php  }  ?>


<?php if (isset ($sellersProducts)  && ( count($sellersProducts) >0 ) )  ?>
<section class="my-5">
<div class="container">
<div class="col-xl-12">
<h2 class="text-center text-info" style="font-family: 'Sen', sans-serif;">@lang('home.products_show_other')</h2>
</div>

  <div id="carouselThreeColumn" class="carousel slide" data-ride="carousel" style="margin-top:-80px;">
    <ol class="carousel-indicators">
      <li data-target="#carouselThreeColumn" data-slide-to="0" class="active"></li>
      <li data-target="#carouselThreeColumn" data-slide-to="1"></li>
    
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
          <div class="row">
                                       @foreach($sellersProducts->take(3) as $sellersProduct)
            <div class="col-xl-4 p-1">                                                 
              <div class="card">
               {{--  <img src="{{ $product->Photo }}" class="w-100" style="width:100%;height:10%;"> --}}
               @if($product->Photo)
               <img  src="{{ $product->Photo }}" style="width: 375px;height:350px;">
               @else 
               <img  src="/images/frontend_images/product-default.png" style="width: 375px;height:350px;">
           @endif
                <div class="card-body mytable">
                  <h4 class="card-title" style="font-family: 'Sen', sans-serif;">{{ $sellersProduct->ProductName }} </h4>
                                                                  
                  <p class="card-text" style="font-family: 'Sen', sans-serif;"><i class="fa fa-inr fa-lg"></i> {{ $sellersProduct->Price }}</p>
            
                 <a href="{{ route('products.show',$sellersProduct->ProductID) }}" class="btn btn-outline-success w-100" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.show')</a>
                
                </div>
              </div>
            </div>     
           
             @endforeach
           
          </div>
      </div>
      
      <div class="carousel-item">
      <div class="row">
                     @foreach($sellersProducts->take(3) as $sellersProduct)
            <div class="col-xl-4 p-1">                                                 
              <div class="card">
                <!-- <img src="/images/products/{{ $sellersProduct->Photo }}" class="w-100" style="width:100%;height:10%;"> -->
                     @if($product->Photo)
                             <img  src="{{ $sellersProduct->Photo }}" style="width: 375px;height:350px;">
                             @else 
                             <img  src="/images/frontend_images/product-default.png" style="width: 375px;height:350px;">
                             @endif
                <div class="card-body mytable">
                  <h4 class="card-title">{{ $sellersProduct->ProductName }}</h4>
                  <p class="card-text"><i class="fa fa-inr fa-lg"></i> {{ $sellersProduct->Price }}</p>
               <a href="{{ route('products.show',$sellersProduct->ProductID) }}" class="btn btn-outline-success w-100" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">Show</a>
                
                </div>
              </div>
            </div>     
           
                                                    @endforeach
          </div>
    </div>
    <br/><br/>
    <a class="carousel-control-prev" href="#carouselThreeColumn" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselThreeColumn" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div> 
</section>



@include('sweetalert::alert')   

@endsection
