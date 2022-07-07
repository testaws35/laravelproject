@extends('layouts.app1')
   <style>
  /* Price Table*/
.pb-100 {
	padding-bottom: 100px;
}
.pt-100 {
	padding-top: 100px;
}
a{
    text-decoration:none;
}
.section-title h4 {
  font-size: 14px;
  font-weight: 500;
  color: #777;
}
.section-title h2 {
	font-size: 32px;
	text-transform: capitalize;
	margin: 15px 0;
	display: inline-block;
	position: relative;
	font-weight: 700;
	padding-bottom: 15px;
	letter-spacing: 1px;
	text-transform: uppercase;
}
.section-title p {
	font-weight: 300;
	font-size: 14px;
}
.black-bg .section-title h2, .black-bg .section-title h4, .black-bg .section-title p {
  color:#fff
}
.section-title h2:before {
  position: absolute;
  content: "";
  width: 150px;
  height: 1px;
  background-color: #777;
  bottom: 0;
  left: 50%;
  margin-left: -75px;
}
.section-title h2:after {
  position: absolute;
  content: "";
  width: 80px;
  height: 3px;
  background-color: #e16038;
  border: darkblue;
  bottom: -1px;
  left: 50%;
  margin-left: -40px;
}
.section-title {
  margin-bottom: 70px;
}
.single-price {
	text-align: center;
	padding: 30px;
	box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
}
.price-title h4 {
  font-size: 24px;
  text-transform: uppercase;
  font-weight: 600;
}
.price-tag {
  margin: 30px 0;
}
.price-tag {
	margin: 30px 0;
background-color: #fafafa;
	color: #000;
	padding: 10px 0;
}
.center.price-tag {
	background-color: tomato;
	color:#fff
}
.price-tag h2 {
	font-size: 45px;
	font-weight: 600;
	font-family: poppins;
}
.price-tag h2 span {
  font-weight: 300;
  font-size: 16px;
  font-style: italic;
}
.price-item ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.price-item ul li {
  font-size: 14px;
  padding: 5px 0;
  border-bottom: 1px dashed #eee;
  margin: 5px 0;
}
.price-item ul li:last-child {
  border-bottom: 0;
}
.single-price a {
  margin-top: 15px;
}
a.box-btn {
	background-color: tomato;
	padding: 5px 20px;
	display: inline-block;
	color: #fff;
	text-transform: capitalize;
	border-radius: 3px;
	font-size: 15px;
	transition: .3s;
}
a.box-btn:hover, a.border-btn:hover {
	background-color: #d35400;
}

    </style>
  </style>
@section('content')

<!-- Matrimonial Price Plans   -->
    <div  style="background-color:#fff;margin-top:-100px">
      <section class="pricing-area pt-100 pb-100" id="pricing">
               <div class="container">
                   <div class="row">
                       <div class="col-xl-8 mx-auto text-center" style="font-family: 'Sen', sans-serif;">
                           <div class="section-title">
                               
                               <h2>Seller Membership Plans</h2>
                               <p>It is a platform where all Sellers can interract and meet each other.</p>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                      <div class="col-xl-4">
                      <div class="single-price" style="font-family: 'Sen', sans-serif;">
                         <div class="price-title">
                           <h4>Silver</h4>
                         </div>
                         <div class="price-tag">
                           <h2>1500<span>Per Year</span></h2>
                         </div>
                         <div class="price-item">
                           <ul>
                              <li>Login</li>
                              <li>Available all basic features</li>
                              <li>Register as Seller</li>
                              <li>Upload all your products</li>
                              <li>Customers will contact you directly</li>
                           </ul>
                         </div>
                         <a href="/onlinePay?typ=1" class="box-btn"  style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">Pay Now</a>
                        
                      </div>
                      </div>
                      <div class="col-xl-4">
                           <div class="single-price" style="font-family: 'Sen', sans-serif;">
                                   <div class="price-title">
                                     <h4>Gold</h4>
                                   </div>
                                   <div class="price-tag">
                                     <h2><i class="fa fa-inr"></i>2500 <span>Per Year</span></h2>
                                   </div>
                                   <div class="price-item">
                                     <ul>
                                <li>Login</li>
                               <li>Available all basic features</li>
                               <li>Register as Seller</li>
                               <li>Upload all your products</li>
                               <li>Customers will contact you directly</li>
                                     </ul>
                                   </div>
                                   <a href="/onlinePay?typ=2"  class="box-btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">Pay Now</a>
                                </div>
                      </div>
                      <div class="col-xl-4">
                       <div class="single-price" style="font-family: 'Sen', sans-serif;">
                         <div class="price-title">
                           <h4> Diamond</h4>
                         </div>
                         <div class="price-tag">
                           <h2><i class="fa fa-inr"></i>5000 <span>Per Year</span></h2>
                         </div>
                         <div class="price-item">
                           <ul>
                               <li>Login</li>
                               <li>Available all basic features</li>
                               <li>Register as Seller</li>
                               <li>Upload all your products</li>
                               <li>Customers will contact you directly</li>
                           </ul>
                         </div>
                         <a href="/onlinePay?typ=3"  class="box-btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">Pay Now</a>
                      </div>
                      </div>
                   </div>
               </div>
    </section>
    
   </div><!--END  Div1 -->




@endsection
