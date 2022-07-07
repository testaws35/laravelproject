@extends('layouts.app1')

@section('content')



    <div class="row">
    <div class="col-lg-12 margin-tb">
    <h2 class="text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.products_edit_heading')</h2>

        </div>

    </div>



@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

   @endif


        <div class="container" style="margin-top:-80px;">	
        <div class="card" style="box-shadow: 5px 10px 18px #888888;">
                <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                    
                     

            <div class="row">
                    <Input type="hidden"  name="ProductID" value="{{ $product->ProductID }}">
                <aside class="col-sm-5 border-right">
        <article class="gallery-wrap"> 
        <div class="img-big-wrap">
          <div> <a href="#">
                
            <img src="{{ $product->Photo }}"></a></div>
        </div> <!-- slider-product.// -->
        <div class="img-small-wrap">
          <div class="item-gallery"> <img src="{{ $product->Photo }}"> </div>
          <div class="item-gallery"> <img src="{{ $product->Photo }}"> </div>
          <div class="item-gallery"> <img src="{{ $product->Photo }}"> </div>
          <div class="item-gallery">  <input type="file"  id="Photo"onchange="checkfile()" name="Photo" >  <p class="error-block" id="Photo_error" style="color:red;"></p> </div>
           {{--  <input type="file" class="form-control"  name="Photo" placeholder="upload product photo"> --}}
        </div> <!-- slider-nav.// -->
        </article> <!-- gallery-wrap .end// -->
                </aside>
                <aside class="col-sm-7">
        <article class="card-body p-5" style="font-family: 'Sen', sans-serif;">
                <input type="text" name="ProductName" value="{{ $product->ProductName }}" class="form-control" placeholder="Product Name">
        
        <p class="price-detail-wrap"> 
            <span class="price h3 text-warning" style="font-family: 'Sen', sans-serif;"> 
                <span class="currency"><i class="fa fa-inr" aria-hidden="true"></i>
                </span><span class="num"> <input class="form-control"  name="Price" value="{{ $product->Price }}" > </span>
            </span> 
            <!--<span>/per kg</span> -->
        </p> <!-- price-detail-wrap .// -->
        <dl class="item-property">
          <dt style="font-family: 'Sen', sans-serif;">@lang('home.products_create_productdesc')</dt>
          <dd style="font-family: 'Sen', sans-serif;"> <textarea class="form-control"  name="Description" rows="10" placeholder="Detail">{{ $product->Description }}</textarea></dd>
        </dl>
        <dl class="param param-feature">
         <dt style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_phydetails_weight')</dt>
          <dd style="font-family: 'Sen', sans-serif;"> <input class="form-control"  name="Weight" value="{{ $product->Weight }}" >&nbsp;Grams</dd>
        </dl>  <!-- item-property-hor .// -->
        <dl class="param param-feature">
         <dt for="Carats" style="font-family: 'Sen', sans-serif;">@lang('home.products_create_carats')</dt>
          <dd style="font-family: 'Sen', sans-serif;"> <input class="form-control"  name="Carats" value="{{ $product->Carats }}" ></dd>
        </dl>  <!-- item-property-hor .// -->
        {{-- dl class="param param-feature">
          <dt>Delivery</dt>
          <dd>Bangalore and Mysuru</dd>
        </dl> --}}  <!-- item-property-hor .// -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" onclick="photocheck()" class="btn ml-4" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_finalsubmitbtn')</button>
                <a class="btn ml-4" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-family: 'Sen', sans-serif;" href="{{ route('products.index') }}"> @lang('home.templefunc_create_cancel')</a>
      
      
              </div>
        </div> <!-- row.// -->
    </form> 
        </div> <!-- card.// -->
        
        
        </div>
        <!--container.//-->
        
      



{{-- 

<form action="{{ route('products.update',$product) }}" method="POST">

    @csrf

    @method('PUT')



     <div class="row">


               

        <Input type="hidden"  name="ProductID" value="{{ $product->ProductID }}"  >
         
   

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Product Name:</strong>

                <input type="text" name="ProductName" value="{{ $product->ProductName }}" class="form-control" placeholder="Product Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Description:</strong>

                <textarea class="form-control" style="height:150px" name="Description" placeholder="Detail">{{ $product->Description }}</textarea>

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">
    
                    <strong>Upload Product Photo:</strong>
    
                    <input type="file" class="form-control" style="height:150px" name="Photo" placeholder="upload product photo">
                    <div class="form-group col-md-6">
                            <img src="{{ $product->Photo }}" width="200" height="200">
                        </div>
                </div>
               
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">
    
                    <strong>Weight:</strong>
    
                    <input class="form-control" style="height:150px" name="Weight" value="{{ $product->Weight }}" >
    
                </div>
    
            </div>
       
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">
    
                    <strong>Price:</strong>
    
                    <input class="form-control" style="height:150px" name="Price" value="{{ $product->Price }}" >
    
                </div>
    
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
        
                        <strong>Carats:</strong>
        
                        <input class="form-control" style="height:150px" name="Carats" value="{{ $product->Carats }}" >
        
                    </div>
        
             </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

          <button type="submit" class="btn btn-info">Submit</button>
          <a class="btn btn-info" href="{{ route('products.index') }}"> Cancel</a>


        </div>

    </div>



</form> --}}

@include('sweetalert::alert')   


@endsection
