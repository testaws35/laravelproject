@extends('layouts.app1')
@section('content')



<!DOCTYPE html>

<html>

<head>

    <title>Products</title>

    <!-- Latest compiled and minified CSS -->

    <!-- References: https://github.com/fancyapps/fancyBox -->
 {{--    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 --}}
{{-- 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="{{ asset('js/frontend_js/jquery.jscroll.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 --}}
    <style type="text/css">

@media (min-width: 992px){
  
  .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 
    {float: left;}
}


/* Limited Charaters in EVENTS Menu */
  .mytable p{
  max-width:900px; /* Customise it accordingly */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.mytable h4 {
  color:#000;
  max-width:310px; /* Customise it accordingly */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.btnproColor {color:#000000;}
/* Limited Charaters in EVENTS Menu */

#loadMore {
    padding-bottom: 30px;
    padding-top: 30px;
    text-align: center;
    width: 100%;
}
#loadMore a {
    background: #042a63;
    border-radius: 3px;
    color: white;
    display: inline-block;
    padding: 10px 30px;
    transition: all 0.25s ease-out;
    -webkit-font-smoothing: antialiased;
}
#loadMore a:hover {
    background-color: #021737;
}


.infinite-scroll{width: 100%;margin-left: 20px;}
</style>

<style>


.filter {
  margin: 30px 0 10px;
}

.filter a {
  display: inline-block;
  padding: 10px;
  border: 2px solid #333;
  position: relative;
  margin-right: 20px;
  margin-bottom: 20px;
}

.boxes {
  display: flex;
  flex-wrap: wrap;
}

.boxes a {
  width: 23%;
  border: 2px solid #333;
  margin: 0 1% 20px 1%;
  line-height: 60px;
}

.all {
  background: khaki;
}

.green {
  background: lightgreen;
}

.blue {
  background: lightblue;
}

.red {
  background: lightcoral;
}

.filter a.active:before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  display: inline-block;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 15px 15px 0 0;
  border-color: #333 transparent transparent transparent;
}

.is-animated {
  animation: .6s zoom-in;
}

@keyframes zoom-in {
  0% {
   transform: scale(.1);
  } 
  100% {
    transform: none;
  }
}



</style>



</head>


<body>
  <form name="sort" id="sort"  method="post" action="{{route('products.index')}}" >
  <!-- Search form -->
    @csrf  

    {{-- <div class="row">
          <form class="form-horizontal" method="GET" action="{{route('products.index')}}" enctype="multipart/form-data">

          <div class="col-md-4">
            <input class="form-control form-control-sm" type="search" name="q" >
          </div>
      
            <div class="col-md-2 col-3">
            <button type="submit" class="w-100 btn btn-sm bg-blue"   > <h1>Filter  </h1></button> 
          </div>

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
      </div> --}}
  

<!-- Start Shop Page -->
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" >
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
      <div class="shop__sidebar">
       
        <aside class="wedget__categories poroduct--cat">
          <h3 class="wedget__title">@lang('home.products_cate_heading')</h3>

          <form id="prodindex"  >
                <ul class="properties-filter">
                      
                    @foreach ($subcategorys as  $subcat)
                                     
                      <li  class="selected" name="{{$subcat->SubCategoryID}}" id="SubCategoryID"  ><a href="?SubCategoryID={{$subcat->SubCategoryID}}" id="catsub"  data-filter="{{$subcat->SubCategoryID}}" onclick="setvalue()" class="click">{{ucwords($subcat->SubCategoryName )}}</a>
                      </li> 
                     
                    @endforeach  
                </ul>
          </form>
        </aside>
        <script>
            function setvalue(){
                
                var a = document.getElementById("catsub").href;
              /*  aruna tried this
               * var e= document.getElementById("sortKey");

                var middleurl = e.options[e.selectedIndex].value;

                if (middleurl === "new"){
                 a = a+"&sortKey=new";
                }
                else if (middleurl === "high"){
                  a = a+"&sortKey=high";
                }
                else if (middleurl === "low"){ 
                     a = a+"&sortKey=high";
                }
               else{
                     a = a+"&sortKey=default";
                }*/
            }
        </script>

        <aside class="wedget__categories pro--range">
          <h3 class="wedget__title">@lang('home.products_heading_filterprice')</h3>
          <div class="content-shopby">
              <div class="price_filter s-filter clear">
                  <form action="{{route('products.index')}}" method="GET">
                      <div class="slider__range--output">
                          <div class="price__output--wrap" style="font-family: 'Sen', sans-serif;">
                              @lang('home.products_heading_filter_minprice')  <input class="form-control" type="number" minlength="2" maxlength="3" placeholder ="Enter min amount" name="min_price" id="min_price">
                              @lang('home.products_heading_filter_maxprice')  <input class="form-control" type="number"  minlength="2" maxlength="3" placeholder ="Enter max amount" name="max_price" id="max_price">
                                  <input class="btn" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" type="submit" value="GO">
                          </div>
                      </div>
                  </form>
              </div>
            </div>
        </aside>


        <aside class="wedget__categories poroduct--tag">
          <h3 class="wedget__title">@lang('home.products_sellers_heading')</h3>
           <ul style="font-family: 'Sen', sans-serif;">
            @if (isset($sellers) && count($sellers) >0 )
              @foreach ($sellers as  $seller)
                 <li class="selected"><a href="?sellerID={{$seller->SellerID}}" data-filter="*" class="click">{{ucwords($seller->Name )}}</a>
                 </a></li> 
              @endforeach  
            @endif
           </ul>
        </aside>
    
      </div>
    </div>



    <div class="col-lg-9 col-12 order-1 order-lg-2">
      <div class="row">
        <div class="col-lg-12">
          <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                   <div class="shop__list nav justify-content-center" role="tablist">
                        {{-- <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a> --}}
                    </div>
                    <p>{{$products->links()}}</p>
                    <div class="orderby__wrapper" >
                    
                      <span>Sort By</span>
                      <select name="sortKey" id="sortKey"  onchange="sortRes()" >
                      {{-- class="shot__byselect"> --}}
                          <option value="default">Default sorting</option>
                          <option value="new">Newest</option>
                          <option value="low">Price: Low to High</option>
                          <option value="high">Price: High to Low</option>
                       </select>
                      
                    </div>
          </div>
        </div>
      </div> 


      <div class="tab__container">
        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
          <div class="row">
             <div class="title">
               
                  <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;margin-left:50px;">@lang('home.viewallitems_menu')&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                    @if(\Auth::user()->IsSeller==1)   
                       <a class="btn" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" href="{{ route('products.create') }}"><b style="font-size:15px;font-family: 'Sen', sans-serif;">@lang('home.products_right_uploadproducts_btn')</b></a>  
                    @endif 
                  </h1>   
                  
              </div>

           
            {{-- <div class="container"> 
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif  
            </div> --}}

          <div id="products" class="infinite-scroll">
		  
          <!--Right side page -->
          @if(isset($products) && count($products) >0)
               @foreach ($products as $product)
                       <div class="col-md-4 moreBox" >
                            <div class="card card-profile">
                                <div class="card-header card-header-image">
                                    <a href="{{ route('products.show',$product->ProductID) }}">
                                  @if($product->Photo)
                                  <img class="img-thumbnail" src="{{ $product->Photo }}">
                                  @else 
                                  <img class="img-thumbnail" src="/images/frontend_images/product-default.png">
                                  @endif

                                    </a>
                                    <div class="colored-shadow" style="background-image: url('{{ $product->Photo }}');opacity: 1;"></div>
                                    
                                    </div> <!-- card header end -->
                            
                                    <div class="card-body mytable">
                                          <!--  <h6 class="card-category text-info">Madurai Viswakarma Sangam Meeting</h6>-->
                                            <h4 class="card-title" style="font-family: 'Sen', sans-serif;font-size:20px;">{{ $product->ProductName }}</h4>
                                            <p class="card-description" style="font-family: 'Sen', sans-serif;">
                                              <i class="fa fa-inr fa-lg btnproColor" >  {{ $product->Price }}</i> <br/><br/>
                                              <a href="{{ route('products.show',$product->ProductID) }}" class="btn waves-effect" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-family: 'Sen', sans-serif;font-size:14px;"> @lang('home.temple_functions_readmore_btn')
                                              
                                              </a> 
                                            </p>
                                    </div><!-- card body end -->
                        
                                  </div>
                  
                    </div> <!-- End col-md-4 -->
                  @endforeach
            @else
                </br>
                </br>
                <p>  Sellers are yet to start publishing their products.. Kindly keep checking this space for exciting Jewel collection!!!</p>
            @endif
            </div> <!-- END infinite-scroll -->
            

            <script type="text/javascript">
    
              /* The below line can be made to either show pagination index or hide it. 
              If pagination is needed, then make it as $('ul.pagination').show(); and remove the function below*/
          
                  $('ul.pagination').hide();
                  $(function() {
                      $('.infinite-scroll').jscroll({
                          autoTrigger: true,
                          loadingHtml: '<img class="center-block" src="https://demos.laraget.com/images/loading.gif" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
                          padding: 0,
                          nextSelector: '.pagination li.active + li a',
                          contentSelector: 'div.infinite-scroll',
                          callback: function() {
                              $('ul.pagination').remove();
                          }
                      });
                  });

                  function sortRes()
                  {

                    var e= document.getElementById("sortKey");
                    var a = <?php echo $CatID  ?>;
                    var middleurl = e.options[e.selectedIndex].value;

                    if (middleurl == "new"){
                        //adding SubCategory also during sorting
                      if((a)  && a>0)
                      {
                          var tmp = "{{url('/products')}}"+ "?sortKey=new&SubCategoryID=";
                          tmp =tmp+a;
                          window.location.href = tmp;
                      }
                      else
                      {
                           window.location.href = "{{url('/products?sortKey=new')}}";
                      }

                    }
                    else if (middleurl == "high"){
                      if((a)  && a>0)
                      {
                         var tmp = "{{url('/products')}}"+ "?sortKey=high&SubCategoryID=";
                         tmp =tmp+a;
                         window.location.href = tmp;
                      }
                      else
                      {
                           window.location.href = "{{url('/products?sortKey=high')}}";
                      }
                    }
                    else if (middleurl == "low"){ 
                      if((a)  && a>0)
                      {
                         var tmp = "{{url('/products')}}"+ "?sortKey=low&SubCategoryID=";
                         tmp =tmp+a;
                         window.location.href = tmp;
                      }
                      else
                      {
                           window.location.href = "{{url('/products?sortKey=low')}}";
                      }
                        
                    }
                    else{
                      if((a)  && a>0)
                      {
                         var tmp = "{{url('/products')}}"+ "?sortKey=default&SubCategoryID=";
                         tmp =tmp+a;
                         window.location.href = tmp;
                      }
                      else
                      {
                          window.location.href = "{{url('/products?sortKey=default')}}";
                      }
                       
                    }
                    
                   

                  }
              </script>

           
          </div><!-- END ROW -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End Shop Page -->



</body>

</html>
        

@include('sweetalert::alert')   

@endsection
