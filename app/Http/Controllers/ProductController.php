<?php

// classname - ProductController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Jewellery feature
// created date - Nov 2019

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use DB;
use Session;
use Auth;

use App\User;
use App\Category;
use App\Subcategory;
use App\Product;
use Lang;

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        // set default values 
        $sortBy = 'ProductName';
        $orderBy = 'asc';
        $perPage = 20;
        $q = null;
      
        if (isset($request->sortKey))
        {
            if (strcmp($request->sortKey,"default") ==0 ) {
                    $sortBy = "ProductName";
                    $orderBy="Asc";
                   
            }
            else if (strcmp($request->sortKey,"new") ==0){
                    $sortBy = "products.CreatedOn";
                    $orderBy="Desc";
            }
            else if (strcmp($request->sortKey,"low") ==0) {
                    $sortBy = "products.Price";
                    $orderBy="Asc";
            }
            else if (strcmp($request->sortKey,"high") ==0){
                    $sortBy = "products.Price";
                    $orderBy="Desc";
            }
            else{
                    $sortBy = "ProductName";
                    $orderBy="Asc";
                }

        }
        
        if (isset($request->q))
        {
            $q = $request->q;
        }
        
        if (Input::get('href') != null)
        {
            $filter = Input::get('href');
        }
  
        //get all products that are active and from all active sellers in the beginning
        
        $query = DB::table('products')
                ->join('demo_subcategory', 'demo_subcategory.SubCategoryID', '=', 'products.SubCategoryID')
                ->join('seller', 'seller.SellerID', '=', 'products.SellerID')
                ->where('products.Status',1)
                ->where('seller.Status',1)
                ->orderBy($sortBy,$orderBy);
               
        

        // This is for the Search panel in the top in Jewellery/product page
        if(isset($q)) {
            // This will only execute if you received any keyword
            $query = $query->where('ProductName','LIKE','%'.$q.'%')
                            ->orWhere ( 'products.Description', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'Weight', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'Price', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'seller.Name', 'LIKE', '%' . $q . '%' ) 
                            ->orWhere ( 'SubCategoryName', 'LIKE', '%' . $q . '%' ) ;
        } 

        // This is for the LHS panel subcategories like Anklets, Chains etc.. selection
       if(isset($request->SubCategoryID))  {
            // This will only execute if you received any SubcategoryID
            $query = $query->where( 'products.SubCategoryID',$request->SubCategoryID ); 
        } 
        
       

        // This is for the LHS panel price panel selection
        if(isset($request->min_price) && isset($request->max_price)){
            // This will only execute if you received any price
            // Make you you validated the min and max price properly
            $query = $query->where('Price','>=',$request->min_price)
                           ->where('Price','<=',$request->max_price);
        }

        // This is for the LHS  Seller panel selection
        if(isset($request->sellerID)) {
            // This will only execute if you received any Seller selection
            $query = $query->where('products.SellerID','=',$request->sellerID);
        }
        
        $products = $query ->paginate(15);
        $subcategorys = DB::table("demo_subcategory")
                        ->orderby("SubCategoryName","ASC")
                        ->get();

        $sellers = DB::table('seller')
                    ->orderby('seller.Name','ASC')
                    ->get();   
                    
        //this is for knowing selected CategoryID 
        $CatID =$request->SubCategoryID? $request->SubCategoryID : 0;
        return view('products.index', compact('products', 'orderBy', 'sortBy', 'perPage', 'subcategorys','sellers','CatID'));
       
  }// function end


   /**
     * Get Ajax Request and return Data
     *
     * @return \Illuminate\Http\Response
     */
    public function myformAjax($CategoryID)
    {

        // for the given Category like Jewellery we are selecting the Subcategories
        $subcategorys = DB::table("demo_subcategory")
                             ->where("CategoryID",$CategoryID)
                             ->pluck("SubCategoryName","SubCategoryID");
                        
                        return json_encode($subcategorys);
    }
   


    /**
     * Get Ajax Request and return Data
     * Get the list of Product Subcategories like for Jewellery Product -Sub categories like Anklets, Chains etc...
     * @return \Illuminate\Http\Response
     */
    public function getSubcategoryList(Request $request)
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
            }


           // set default values 
            $sortBy = 'SubCategoryName';
            $orderBy = 'asc';

          
            if (isset($request->sortKey))
            {
                if (strcmp($request->sortKey,"default") ==0 ) {
                        $sortBy = "ProductName";
                        $orderBy="Asc";
                       
                }
                else if (strcmp($request->sortKey,"new") ==0){
                        $sortBy = "products.CreatedOn";
                        $orderBy="Desc";
                }
                else if (strcmp($request->sortKey,"low") ==0) {
                        $sortBy = "products.Price";
                        $orderBy="Asc";
                }
                else if (strcmp($request->sortKey,"high") ==0){
                        $sortBy = "products.Price";
                        $orderBy="Desc";
                }
                else{
                        $sortBy = "ProductName";
                        $orderBy="Asc";
                    }
    
            }
        
          $subcategory = DB::table("demo_subcategory")
                        ->select("SubCategoryID","SubCategoryName")
                        ->where("CategoryID",$request->CategoryID)
                        ->orderby($sortBy,$orderBy)
                        //it is another way of selecing columns like select clause
                        //->pluck("SubCategoryName","SubCategoryID")
                        // this maintains the sort order in the json payload when returning response to View
                        //if dont use this the order is not seen in view
                        ->values();
                       
                        return response()->json($subcategory);
    } 




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
            }
        
        $categorys = DB::table("demo_category")
                ->pluck("CategoryName","CategoryID");
        return view('products.create', compact('categorys'));
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
       //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
               return view('auth.SessionTimeout');
        } 
             
      
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {


            // Storing the Product Details
                            
            $input =  new Product;
            $input->ProductName = $request->get('ProductName');
            $input->Description = $request->get('Description');
            $input->Weight = $request->get('Weight');
            $input->Price = $request->get('Price');
            $input->Carats = $request->get('Carats');
            $input->SubCategoryID = $request->get('SubCategoryID');
            
            
            if ($request->Photo != null ){
                
                    $uri = '/images/products/';
                    $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                    $input['Photo'] = $uri.$name;
                    $request->Photo->move(public_path('images/products'), $name);
            }
            
            $seller = DB::table('seller')
                    ->select('seller.SellerID', 'seller.UserID')
                    ->where('seller.UserID','=',Auth::user()->id)
                    ->first();  

            $input->SellerID =$seller->SellerID;
            $input->Status =1;
            $input->Createdby = Auth::user()->id; 
            $input->CreatedOn = date('Y-m-d');
            $input->Modifiedby = Auth::user()->id; 
            $input->ModifiedOn = date('Y-m-d');
            
            $input->save();
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('products.index')
                        ->with('success',Lang::get('home.success_msg'));
            
            } 
            else {
                DB::rollback();
               // throw new Exception;
                return redirect()->route('products.index')
                        ->with('error',Lang::get('home.fail_msg'));
            }
        }
        catch(Exception $e) {
           // throw new Exception;
            DB::rollback();
            return redirect()->route('products.index')
                        ->with('error',Lang::get('home.fail_msg'));
        }

     

    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit($ProductID)
    {
           //Check for Session time out and redirect to Login page on Session time out 
           if ( ! Auth::check()){
            return view('auth.SessionTimeout');
             }

            if(isset($ProductID)){
                    $product = Product::find($ProductID);
                    return view('products.edit',compact('product'));
            }
            else{

                return view('products.edit')
                ->with('Failed',Lang::get('home.fetch_error'));
            }
    }

  
   /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($ProductID)

    {
           //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }  

          if(isset($ProductID)){
                $product = Product::find($ProductID);

                if (isset($product)) {

                    $seller = DB::table('seller')
                    ->select('seller.SellerID','seller.Name', 'seller.CompanyName', 'seller.seller_Mobile', 'seller.Location', 'seller.UserID')
                    ->where('seller.SellerID','=',$product->SellerID)
                    ->orderby('seller.Name','DESC')
                    ->first();   
    
                    if (! isset($seller)){
                        $seller=null;
                        $sellersProducts = null;
                        return view('products.show',compact('product', 'seller', 'sellersProducts'));
                    }
                    else{
                        $sellersProducts = DB::table('products')
                                    ->where ('products.SellerID', $seller->SellerID)
                                    ->orderby('products.ProductName','ASC')
                                    ->get(); 

                        return view('products.show',compact('product', 'seller', 'sellersProducts'));
                    }
                }//product check if
                else{
                    $product = null;
                    $seller = null;
                    $sellersProducts = null;
                    return view('products.show')
                           ->with ("error",Lang::get('home.product_err'));
                }
        }
        else
        {
            $product = null;
            $seller = null;
            $sellersProducts = null;
            return view('products.show')
                      ->with ("Failed",Lang::get('home.product_empty'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

             $input = Product::find($request->ProductID);
            
             if (isset($input)){
                    $input->ProductName = $request->ProductName;
                    $input->Description = $request->Description;
                    $input->Weight = $request->Weight;
                    $input->Price = $request->Price;
                    $input->Carats = $request->Carats;

                    if ($request->Photo != null   ){
                        $uri = '/images/products/';
                        $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                        $input['Photo'] = $uri.$name;
                        $request->Photo->move(public_path('images/products'), $name);
                    }

                    $input->Modifiedby = Auth::user()->id;;  
                    $input->ModifiedOn = date('Y-m-d'); 
 
                    $input->save();
           
             }
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('products.index')
                ->with('success',Lang::get('home.updated_success'));
            
            } else {
                DB::rollback();
                //throw new Exception;
                return redirect()->route('products.index')
                ->with('error',Lang::get('home.updated_fail'));
            }

        }
        catch(Exception $e) {
           // throw new Exception;
            DB::rollback();
            return redirect()->route('products.index')
            ->with('error',Lang::get('home.updated_fail'));
        }



    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy($ProductID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        
        //we are doing soft Delete only
       $varproduct = Product::find($ProductID);
       if (isset($varproduct)){
             $varproduct->Status = 0;
             $varproduct->save();
             return redirect()->route('products.index')->with('success',Lang::get('home.deletion_success'));
       }
       else{
             return redirect()->route('products.index')->with('error',Lang::get('home.deletion_fail'));
       }
    }
   
   

}
