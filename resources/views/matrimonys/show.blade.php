@extends('layouts.app1')

@section('content')

<!-- checking whether Profile data is empty-->
<?php if ( isset($matrimony)  ) {?>
<h1 class="text-uppercase text-dark text-center" style="font-family: 'Sen', sans-serif;" >Profile Details of {{ $matrimony->ProfileUser_Name }}</h1>
<br/><div class="container" style="margin-top:-110px;">

    <div class="row" >
            <div class="col-lg-4">
               <div class="profile-card-4 z-depth-3">
                <div class="card" style="font-family: 'Sen', sans-serif;">
                  <div class="card-body text-center bg-white rounded-top" style="color:#000000;font-size: 18px;font-weight: 400;">
                  
                   <!--  <img src="/images/matrimonys/userphotos/{{ $matrimony->ProfileUser_Photo }}" alt="Profile Photo">
                   -->
                       @if($matrimony->ProfileUser_Photo)
                             <img class="img-thumbnail" src="{{ $matrimony->ProfileUser_Photo }}" alt="{{ $matrimony->ProfileUser_Photo1 }}">
                          @else 
                             <img class="img-thumbnail" src="/images/frontend_images/avatar.png">
                             @endif    
                  <h3 class="mb-1 text-dark text-uppercase" >{{ $matrimony->ProfileUser_Name }}</h3>
                  <label style="display:none"> {{ $matrimony->RegistrationID }} </label>
                  <h6 class="text-uppercase">{{ $matrimony->ProfileUser_LocationID }}  &nbsp;&nbsp;{{ $matrimony->ProfileUser_Age }} years &nbsp;&nbsp;{{ $matrimony->ProfileUser_Degree }}</h6>
                  <hr> </div>
                  <div class="card-body">
                    <ul class="list-group shadow-none">
                   
                    <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;margin-top:-30px;">
                            <div class="col-md-12 "> Mobile No: {{ $matrimony->ProfileUser_Mobile }} </div>
                            <div class="col-md-12"> Email: {{ $matrimony->ProfileUser_email }}</div>
                            
                       </div>
                   <hr>
                   
                <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;">
                          <div class="col-md-12"> Natchithram: {{ $matrimony->ProfileUser_Natchithram }} </div>
                          <div class="col-md-12"> Rashi: {{ $matrimony->ProfileUser_Rashi }}</div>
                       
                          <div class="col-md-12"> Marital Status: {{ $matrimony->ProfileUser_MaritalStatus }} </div>
                          <div class="col-md-12"> Any Dosam: {{ $matrimony->ProfileUser_AnyDosam }}</div>
                 </div>
                 
                    </ul>
                 </div>
                 </div>
               </div>
            </div>
            
         
            <div class="col-lg-8">  
               <a href="/matrimonys" class="pull-right" title="Back to Matrimonys" style="margin-top:60px;color: #3490dc;"><b style="font-size:15px;">Back to Matrimonys</b></a> 

               <div class="card z-depth-3">

                <div class="card-body" style="font-family: 'Sen', sans-serif;">
               <!-- begin profile-content -->
                <div class="profile-content">
                   <!-- begin tab-content -->
                   <div class="tab-content p-0">
                      <!-- begin #profile-post tab -->
                      <div class="tab-pane fade active show" id="profile-post">
                         <!-- begin timeline -->
                         <ul class="timeline">
                            <li>
                              <!-- begin timeline-icon -->
                               <div class="timeline-icon">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                  <div class="timeline-header">
                                     <!-- <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""></span> -->
                                   <!--    <span class="username"><i class="fas fa-quote-left fa-lg"></i>&nbsp;&nbsp;About &nbsp; {{ $matrimony->ProfileUser_Name }} </span> -->
                                      <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;"><i class="fa fa-quote-left fa-lg"></i>&nbsp;&nbsp;About  </span>
                                    </div>
                                  <div class="timeline-content">
                                    <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;">
                                              <div class="col-md-6">Date of Birth: <br/>
                                                    {{ $matrimony->ProfileUser_DOB }}</div>
                                            <div class="col-md-6">Place of Birth: {{ $matrimony->ProfileUser_PlaceofBirth }} <br/><br/></div>
                                                
                                            <div class="col-md-6">Height:<br/>
                                                    {{ $matrimony->ProfileUser_Height }}</div>
                                            <div class="col-md-6">Address: <br/>{{ $matrimony->ProfileUser_Address }}</div>
                                            
                                            </div><br/><br/> 
                                          <p>
                                            <b style="color:#000000;font-size: 18px;font-weight: 400;"> My Expectation  </b><br/><br/>
                                          <span style="color:#000000;font-size: 18px;font-weight: 400;">  {{ $matrimony->ProfileUser_Description_Expectation }}</span>
                                        </p>
                                  </div>
                                </div>
                               <!-- end timeline-body -->
                            </li>
                            <li>
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                  <div class="timeline-header">
                              <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;">&nbsp;&nbsp;Background</span>
                                   
                                  </div>
                                  <div class="timeline-content">
                                     <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;">
                                        <div class="col-md-6">Caste: <br/>
                                                {{ $matrimony->ProfileUser_Category }}</div>
                                      <div class="col-md-6">Subcaste: {{ $matrimony->ProfileUser_Subcaste }} <br/><br/></div>
                                          
                                      <div class="col-md-6"> Father's Caste:<br/>
                                            {{ $matrimony->ProfileUser_Father_Caste }}</div>
                                      <div class="col-md-6">Mother's Caste: <br/> {{ $matrimony->ProfileUser_Mother_Caste }} <br/><br/></div>
                                      
                                      <div class="col-md-6"> Preffered Caste:<br/>
                                            {{ $matrimony->ProfileUser_PreferrredCaste }}</div>
                                      <div class="col-md-6">Preferred Star: {{ $matrimony->ProfileUser_PreferredStar }}</div>
                                      
                                      </div> 
                                  </div>
                                
                               </div>
                               <!-- end timeline-body -->
                            </li>
                            <li>
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                  <div class="timeline-header">
                                   <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;">&nbsp;&nbsp;Family Details</span>
                                   
                                     <!-- <span class="pull-right text-muted">1,282 Views</span> -->
                                  </div>
                                   <div class="timeline-content">

                                        <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;">
                                                <div class="col-md-6">Father's Name: <br/>
                                                        {{ $matrimony->ProfileUser_FatherName }}</div>
                                              <div class="col-md-6"> Mother's Name: <br/> {{ $matrimony->ProfileUser_MotherName }} <br/><br/></div>
                                                  
                                              <div class="col-md-6"> Occupation:
                                                    {{ $matrimony->ProfileUser_Father_Occupation }}</div>
                                              <div class="col-md-6">Occupation: {{ $matrimony->ProfileUser_Mother_Occupation }} <br/><br/></div>
                                              
                                              <div class="col-md-6">No of Sisters: <br/>
                                                    {{ $matrimony->ProfileUser_Sisters_Num }}</div>
                                              <div class="col-md-6">No of Brothers:<br/> {{ $matrimony->ProfileUser_Brothers_Num }} <br/><br/></div>
                                              
                                                <div class="col-md-6">Married Sisters:<br/>
                                                        {{ $matrimony->ProfileUser_MarriedSis_Num }}</div>
                                                  <div class="col-md-6">Married Brothers:<br/> {{ $matrimony->ProfileUser_MarriedBro_Num }}</div>
                                                  
                                        </div> 
                                  </div>
                               
                               </div>
                               <!-- end timeline-body -->
                            </li>
                            <li>
                             
                               <!-- begin timeline-icon -->
                               <div class="timeline-icon">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               <!-- end timeline-icon -->
                               <!-- begin timeline-body -->
                               <div class="timeline-body">
                                  <div class="timeline-header">
                                <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;">&nbsp;&nbsp;Education & Career</span>
                                  </div>
                                  <div class="timeline-content">

                                        <div class="row" style="color:#000000;font-size: 18px;font-weight: 400;">
                                                <div class="col-md-6">Degree: <br/>
                                                        {{ $matrimony->ProfileUser_Degree }}</div>
                                              <div class="col-md-6"> Designation: <br/>{{ $matrimony->ProfileUser_CurrentDesignation }} <br/><br/></div>
                                                  
                                              <div class="col-md-6"> Current Company:<br/>
                                                    {{ $matrimony->ProfileUser_CurrentCompany }}</div>
                                              <div class="col-md-6">Annual Income: <br/>{{ $matrimony->ProfileUser_Salary }} <br/><br/></div>
                                        </div> 
                              
                                  </div><!-- end timeline-content -->
                               </div>
                               <!-- end timeline-body -->
                            </li>
                            <li>

                                 <!-- begin timeline-icon -->
                                 <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                     </div>
                                     <!-- end timeline-icon -->
                                     <!-- begin timeline-body -->
                                     <div class="timeline-body">
                                        <div class="timeline-header">
                                      <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;">&nbsp;&nbsp;Physical Details</span>
                                        </div>
                                        <div class="timeline-content" style="color:#000000;font-size: 18px;font-weight: 400;">
                                         
                                                <div class="row">
                                                        <div class="col-md-6">Blood Group: <br/>
                                                                {{ $matrimony->ProfileUser_Bloodgroup }}</div>
                                                      <div class="col-md-6"> Physical Status: <br/>{{ $matrimony->ProfileUser_PhysicalStatus }} <br/><br/></div>
                                                          
                                                      <div class="col-md-6"> Disability, if any: <br/>
                                                            {{ $matrimony->ProfileUser_AnyDisability }}</div>
                                                      <div class="col-md-6"> Body Built: {{ $matrimony->ProfileUser_BodyType }} 
                                                            @if($matrimony->ProfileUser_AnyDisability != "no")
                                                            <p> {{ $matrimony->ProfileUser_PhysicallyChallengedDetails }}</p>
                                                            @endif
                                                        <br/><br/></div>
                                                </div> 
                                         
                                           
                                         
                                           {{-- <p><i class="fas fa-rupee-sign fa-1x"></i> Doesn't wish to specify he / she income</p> --}}
                                        </div>
                                     </div>
                                     <!-- end timeline-body -->
                            </li>
                            <li>
                              
                               <div class="timeline-icon">
                                  <a href="javascript:;">&nbsp;</a>
                               </div>
                               
                               <div class="timeline-body">
                                <div class="timeline-header">
                                <span style="color:#000000;font-size: 18px;font-weight: 400;text-transform:uppercase;">&nbsp;&nbsp;Horoscope Details</span>
                                  </div>
                                  <div class="timeline-content">
                                   <!--  <img src="/images/matrimonys/horoscopephotos/{{ $matrimony->ProfileUser_Horoscope }}" class="img-fluid">
                                 -->
                                 @if($matrimony->ProfileUser_Horoscope)
                             <img class="img-thumbnail" src="{{ $matrimony->ProfileUser_Horoscope }}" alt="Horoscope">
                             @else 
                             <img class="img-thumbnail" src="/images/frontend_images/horoscope.png">
                             @endif
                                </div>
                                </div>
                              
                           </li>
                         </ul>
                         <!-- end timeline -->
                      </div>
                      <!-- end #profile-post tab -->
                   </div>
                   <!-- end tab-content -->
                </div>
                <!-- end profile-content -->
            
                
            </div>  
          </div><br/><br/>
          
          
          </div><!-- col 8 -->
            
            
            
            
        </div>
    </div>

   <?php } else{  ?>

      <h2 class="font-bold text-center ">Unable to get Profile details
      </h2>
      <br>
      <br>

   <?php }   ?>
@endsection
