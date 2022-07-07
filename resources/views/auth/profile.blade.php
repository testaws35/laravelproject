@extends('layouts.app1')
@section('content')


<style>
    /*EXTRA*/
    /* User Cards */
    .probody{
    margin-top:-70px;
}
.user-box {
    width: 300px;
    margin: auto;
    margin-bottom: 20px;
    
}

.user-box img {
    width: 100%;
    height:210px;
    border-radius: 50%;
	padding: 3px;
	background: #fff;
	-webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    -ms-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.profile-card-2 .card {
	position:relative;
}

.profile-card-2 .card .card-body {
	z-index:1; 
}
.card-body h5,h6{ font-family: 'Sen', sans-serif;font-size: 13px;font-weight: 300;}
.profile-card-2 .card::before {
    content: "";
    position: absolute;
    top: 0px;
    right: 0px;
    left: 0px;
	border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    height: 112px;
    background-color: #e6e6e6;
}

.profile-card-2 .card.profile-primary::before {
	background-color: #008cff;
}
.profile-card-2 .card.profile-success::before {
	background-color: #15ca20;
}
.profile-card-2 .card.profile-danger::before {
	background-color: #fd3550;
}
.profile-card-2 .card.profile-warning::before {
	background-color: #ff9700;
}
.profile-card-2 .user-box {
	margin-top: 30px;
}

.profile-card-3 .user-fullimage {
	position:relative;
}

.profile-card-3 .user-fullimage .details{
	position: absolute;
    bottom: 0;
    left: 0px;
	width:100%;
}

.profile-card-4 .user-box {
    width: 300px;
    margin: auto;
    margin-bottom: 10px;
    margin-top: 15px;
}

.profile-card-4 .list-icon {
    display: table-cell;
    font-size: 30px;
    padding-right: 20px;
    vertical-align: middle;
    color: #223035;
}

.profile-card-4 .list-details {
	display: table-cell;
	vertical-align: middle;
	font-weight: 600;
    color: #223035;
    font-size: 15px;
    line-height: 15px;
}

.profile-card-4 .list-details small{
	display: table-cell;
	vertical-align: middle;
	font-size: 12px;
	font-weight: 400;
    color: #808080;
}

/*Nav Tabs & Pills */
.nav-tabs .nav-link {
    color: #223035;
	font-size: 12px;
    text-align: center;
	letter-spacing: 1px;
    font-weight: 600;
	margin: 2px;
    margin-bottom: 0;
	padding: 12px 20px;
    text-transform: uppercase;
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
	
}
.nav-tabs .nav-link:hover{
    border: 1px solid transparent;
}
.nav-tabs .nav-link i {
    margin-right: 2px;
	font-weight: 600;
}

.top-icon.nav-tabs .nav-link i{
	margin: 0px;
	font-weight: 500;
	display: block;
    font-size: 20px;
    padding: 5px 0;
}

.nav-tabs-primary.nav-tabs{
	border-bottom: 1px solid #008cff;
}

.nav-tabs-primary .nav-link.active, .nav-tabs-primary .nav-item.show>.nav-link {
    color: #008cff;
    background-color: #fff;
    border-color: #008cff #008cff #fff;
    border-top: 3px solid #008cff;
}

.nav-tabs-success.nav-tabs{
	border-bottom: 1px solid #15ca20;
}

.nav-tabs-success .nav-link.active, .nav-tabs-success .nav-item.show>.nav-link {
    color: #15ca20;
    background-color: #fff;
    border-color: #15ca20 #15ca20 #fff;
    border-top: 3px solid #15ca20;
}

.nav-tabs-info.nav-tabs{
	border-bottom: 1px solid #0dceec;
}

.nav-tabs-info .nav-link.active, .nav-tabs-info .nav-item.show>.nav-link {
    color: #0dceec;
    background-color: #fff;
    border-color: #0dceec #0dceec #fff;
    border-top: 3px solid #0dceec;
}

.nav-tabs-danger.nav-tabs{
	border-bottom: 1px solid #fd3550;
}

.nav-tabs-danger .nav-link.active, .nav-tabs-danger .nav-item.show>.nav-link {
    color: #fd3550;
    background-color: #fff;
    border-color: #fd3550 #fd3550 #fff;
    border-top: 3px solid #fd3550;
}

.nav-tabs-warning.nav-tabs{
	border-bottom: 1px solid #ff9700;
}

.nav-tabs-warning .nav-link.active, .nav-tabs-warning .nav-item.show>.nav-link {
    color: #ff9700;
    background-color: #fff;
    border-color: #ff9700 #ff9700 #fff;
    border-top: 3px solid #ff9700;
}

.nav-tabs-dark.nav-tabs{
	border-bottom: 1px solid #223035;
}

.nav-tabs-dark .nav-link.active, .nav-tabs-dark .nav-item.show>.nav-link {
    color: #223035;
    background-color: #fff;
    border-color: #223035 #223035 #fff;
    border-top: 3px solid #223035;
}

.nav-tabs-secondary.nav-tabs{
	border-bottom: 1px solid #75808a;
}
.nav-tabs-secondary .nav-link.active, .nav-tabs-secondary .nav-item.show>.nav-link {
    color: #75808a;
    background-color: #fff;
    border-color: #75808a #75808a #fff;
    border-top: 3px solid #75808a;
}

.tabs-vertical .nav-tabs .nav-link {
    color: #223035;
    font-size: 12px;
    text-align: center;
    letter-spacing: 1px;
    font-weight: 600;
    margin: 2px;
    margin-right: -1px;
    padding: 12px 1px;
    text-transform: uppercase;
    border: 1px solid transparent;
    border-radius: 0;
    border-top-left-radius: .25rem;
    border-bottom-left-radius: .25rem;
}

.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #dee2e6;
}

.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    border-bottom: 1px solid #dee2e6;
    border-right: 0;
    border-left: 1px solid #dee2e6;
}

.tabs-vertical-primary.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #008cff;
}

.tabs-vertical-primary.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-primary.tabs-vertical .nav-tabs .nav-link.active {
    color: #008cff;
    background-color: #fff;
    border-color: #008cff #008cff #fff;
    border-bottom: 1px solid #008cff;
    border-right: 0;
    border-left: 3px solid #008cff;
}

.tabs-vertical-success.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #15ca20;
}

.tabs-vertical-success.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-success.tabs-vertical .nav-tabs .nav-link.active {
    color: #15ca20;
    background-color: #fff;
    border-color: #15ca20 #15ca20 #fff;
    border-bottom: 1px solid #15ca20;
    border-right: 0;
    border-left: 3px solid #15ca20;
}

.tabs-vertical-info.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #0dceec;
}

.tabs-vertical-info.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-info.tabs-vertical .nav-tabs .nav-link.active {
    color: #0dceec;
    background-color: #fff;
    border-color: #0dceec #0dceec #fff;
    border-bottom: 1px solid #0dceec;
    border-right: 0;
    border-left: 3px solid #0dceec;
}

.tabs-vertical-danger.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #fd3550;
}

.tabs-vertical-danger.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-danger.tabs-vertical .nav-tabs .nav-link.active {
    color: #fd3550;
    background-color: #fff;
    border-color: #fd3550 #fd3550 #fff;
    border-bottom: 1px solid #fd3550;
    border-right: 0;
    border-left: 3px solid #fd3550;
}

.tabs-vertical-warning.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #ff9700;
}

.tabs-vertical-warning.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-warning.tabs-vertical .nav-tabs .nav-link.active {
    color: #ff9700;
    background-color: #fff;
    border-color: #ff9700 #ff9700 #fff;
    border-bottom: 1px solid #ff9700;
    border-right: 0;
    border-left: 3px solid #ff9700;
}

.tabs-vertical-dark.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #223035;
}

.tabs-vertical-dark.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-dark.tabs-vertical .nav-tabs .nav-link.active {
    color: #223035;
    background-color: #fff;
    border-color: #223035 #223035 #fff;
    border-bottom: 1px solid #223035;
    border-right: 0;
    border-left: 3px solid #223035;
}

.tabs-vertical-secondary.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #75808a;
}

.tabs-vertical-secondary.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-secondary.tabs-vertical .nav-tabs .nav-link.active {
    color: #75808a;
    background-color: #fff;
    border-color: #75808a #75808a #fff;
    border-bottom: 1px solid #75808a;
    border-right: 0;
    border-left: 3px solid #75808a;
}

.nav-pills .nav-link {
    border-radius: .25rem;
    color: #223035;
    font-size: 12px;
    text-align: center;
	letter-spacing: 1px;
    font-weight: 600;
    text-transform: uppercase;
	margin: 3px;
    padding: 12px 20px;
	-webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; 

}

.nav-pills .nav-link:hover {
    background-color:#f4f5fa;
}

.nav-pills .nav-link i{
	margin-right:2px;
	font-weight: 600;
}

.top-icon.nav-pills .nav-link i{
	margin: 0px;
	font-weight: 500;
	display: block;
    font-size: 20px;
    padding: 5px 0;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #008cff;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(0, 140, 255, 0.5);
}

.nav-pills-success .nav-link.active, .nav-pills-success .show>.nav-link {
    color: #fff;
    background-color: #15ca20;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(21, 202, 32, .5);
}

.nav-pills-info .nav-link.active, .nav-pills-info .show>.nav-link {
    color: #fff;
    background-color: #0dceec;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(13, 206, 236, 0.5);
}

.nav-pills-danger .nav-link.active, .nav-pills-danger .show>.nav-link{
    color: #fff;
    background-color: #fd3550;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(253, 53, 80, .5);
}

.nav-pills-warning .nav-link.active, .nav-pills-warning .show>.nav-link {
    color: #fff;
    background-color: #ff9700;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(255, 151, 0, .5);
}

.nav-pills-dark .nav-link.active, .nav-pills-dark .show>.nav-link {
    color: #fff;
    background-color: #223035;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(34, 48, 53, .5);
}

.nav-pills-secondary .nav-link.active, .nav-pills-secondary .show>.nav-link {
    color: #fff;
    background-color: #75808a;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(117, 128, 138, .5);
}
.card .tab-content{
	padding: 1rem 0 0 0;
}

.z-depth-3 {
    -webkit-box-shadow: 0 11px 7px 0 rgba(0,0,0,0.19),0 13px 25px 0 rgba(0,0,0,0.3);
    box-shadow: 0 11px 7px 0 rgba(0,0,0,0.19),0 13px 25px 0 rgba(0,0,0,0.3);
}
  
</style>





<h1 class="text-center" style="font-family: 'Sen', sans-serif;">  @lang('home.myprofile_show_heading')</h1>
<div class="container probody">
    <div class="row">
           
            <div class="col-lg-4">
               <div class="profile-card-4 z-depth-3">
                <div class="card">
                  <div class="card-body text-center bg-info rounded-top">
                        <div class="user-box">
                                    @if($userprofile->User_photo)
                                      <!--   <img src="{{$userprofile->User_photo}}" style="border-radius: 50%;border: 1px solid #f82249;" width="50%;" alt="VC"> -->
                                      <img src="{{$userprofile->User_photo}}" style="height:200px; width:200px;"  alt="VC">
                                    @else 
                                        <img class="img-thumbnail" src="/images/frontend_images/avatar.png" style="border-radius: 50%;border: 1px solid #f82249; width: 200px; height: 200px;" alt="VC">
                                    @endif
                        </div>
                        <h5 class="mb-1 text-white"> {{ old('name', $userprofile->name) }}</h5>
                        <h6 class="text-light"> {{ old('email', $userprofile->email) }}</h6>
                     </div>
                  <div class="card-body" style="width:10px;">
                  <ul class="list-group shadow-none">
                  
                  <div class="row">
                        <div class="col-md-4">
                            <li class="list-group-item">
                                <!--<div class="list-icon">
                                    
                                </div>-->
                                <div class="list-details">
                                    <i class="fa fa-phone">&nbsp;&nbsp;&nbsp;<span>{{ old('User_Phone', $userprofile->User_Phone) }}</span></i>
                                </div>
                            </li> 
                            <li class="list-group-item">
                                    <!--<div class="list-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>-->
                                    <div class="list-details">
                                        <i class="fa fa-envelope">&nbsp;&nbsp;&nbsp;<span>{{ old('email', $userprofile->email) }}</span></i>
                                    </div>
                            </li>
                        </div>
                  </div>   
                   
                 
               </ul>
         </div>
         <div class="card-footer text-center">
      </div>
     </div>
   </div>
</div>
        <div class="col-lg-8 myaccount_mrg">
            <div class="card z-depth-3">
              <div class="card-body" style="font-family: 'Sen', sans-serif;font-size:18px;font-weight:600;">
                  
                <ul class="nav nav-pills nav-pills-primary nav-justified">
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active show"> <span class="hidden-xs">@lang('home.myprofile_show_subheading_per')</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"> <span class="hidden-xs">@lang('home.matrimonys_edit_panelfamily')</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#family" data-toggle="pill" class="nav-link"> <span class="hidden-xs">@lang('home.myprofile_show_subheading_tree')</span></a>
                            </li>
                            <!--   show Edit Tab only if the User is the Profil user -->
                            <?php if ($userprofile->id == Auth::user()->id )  { ?>
                                    <li class="nav-item">
                                        <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><span class="hidden-xs">@lang('home.myprofile_show_subheading_edit')</span></a>
                                    </li>
                            <?php }  ?>
                </ul>
                <div class="tab-content p-3" style="overflow:hidden;">
                    <div class="tab-pane active show" id="profile">
                        <div class="row">
                            <div class="col-md-6">
                                    <h6>@lang('home.matrimonys_create_basicdetails_name')</h6>
                                    <p>
                                            {{ old('name', $userprofile->name) }}
                                    </p>
                                    <h6>@lang('home.matrimonys_edit_panelcaste') </h6>
                                    <p>
                                            {{ old('User_Caste', $userprofile->CasteName) }}
                                    </p>
                                    <h6>@lang('home.matrimonys_create_basicdetails_address')</h6>
                                    <p>
                                            {{ old('User_Address', $userprofile->User_Address) }}
                                    </p>
                                    <h6>@lang('home.myprofile_show_subheading_personal_state')</h6>
                                    <p>
                                            {{ old('User_State', $userprofile->statename) }}
                                    </p>
                            </div>
                            <div class="col-md-6">
                                    <h6>@lang('home.matrimonys_create_basicdetails_marstatus')</h6>
                                    <p>
                                            {{ old('User_MaritalStatus', $userprofile->User_MaritalStatus) }}
                                    </p>
                                    <h6>@lang('home.matrimonys_edit_panelsubcaste')</h6>
                                    <p>
                                            {{ old('User_Subcaste', $userprofile->SubCaste_Name) }}
                                    </p>
                                    <h6>@lang('home.myprofile_show_subheading_personal_counryt')</h6>
                                    <p>
                                            {{ old('User_Country', $userprofile->Countryname) }}
                                    </p>
                                    <h6>@lang('home.temples_show_city')</h6>
                                    <p>
                                            {{ old('User_City', $userprofile->cityname) }}
                                    </p>
                            </div>
                <div class="col-md-12">
                    <!-- You have registered as hide / show based on role -->
                    
                    <h5 class="mt-2 mb-3"><span class="fa fa-registered float-right"></span> @lang('home.myprofile_show_bottom_heading')</h5>
                    
                    <table class="table table-hover table-striped">
                        <tbody>                                    
                            <tr>
                                <td>
                                    <!--START ROW -->    
                                    <?php if ($userprofile->id == Auth::user()->id )  { ?>                   
                                          <div class="row">
                                            @if($userprofile->UserroleID == 1 || Auth::user()->UserroleID == 1)
                                                
                                                <div class="col-md-3">
                                                  <a class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.User') </a>      
                                                </div>
                                            @else($userprofile->UserroleID == 2 || Auth::user()->UserroleID == 2)
                                                <div class="col-md-3">
                                                  <a class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.Admin')</a>      
                                                </div>
                                            @endif
                                           @if($userprofile->IsElder == 1 || Auth::user()->IsElder == 1)   
                                                 <div class="col-md-3">
                                                    <img src="/images/frontend_images/icons/couple.png" alt="Elder" title="Elder" width=50; height=50;/>         
                                                  </div>
                             
                                           @endif
                                            @if($userprofile->IsSeller == 1 || Auth::user()->IsSeller == 1)   
                                                 <div class="col-md-3">
                                                    <img src="/images/frontend_images/icons/seller.png" alt="Seller" title="Seller" width=50; height=50;/>         
                                                  </div>
                             
                                           @endif
                                          
                                            
                                           
                                     </div>  <!-- END ROW -->
                                     
                                     
                                 <?php }  ?>
            

                                               
              
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($userprofile->id == Auth::user()->id )  { ?>
                    @if($userprofile->IsElder != 1 ||$userprofile->IsSeller != 1 || Auth::user()->IsSeller != 1) 
                    <h5 class="mt-2 mb-3">@lang('home.myprofile_show_bottom_heading_1')</h5>
                    <table class="table table-hover table-striped">
                        <tbody>                                    
                            <tr>
                                <td>
                                    <!--START ROW -->    
                                                       
                                        <div class="row">
                                            
                                           @if($userprofile->IsElder != 1 || Auth::user()->IsElder != 1 )   
                                                 <div class="col-md-3">
                                                    <a href="/elders" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" name="btnElder"> @lang('home.volunteer') </a>      
                                                 </div>
                                           @endif
                                           
                                            @if($userprofile->IsSeller != 1 || Auth::user()->IsSeller != 1)         
                                                <div class="col-md-3">
                                                        <a href="/sellers/create" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.sellerreg') </a>      
                                                </div>
                                            @endif 
                                            
                                             
                                        </div>  <!-- END ROW -->
                                     
                                 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <?php }  ?>
                    <div class="">
                        <h5 class="mt-2 mb-3">Invite your Friends/Family Members</h5>
                        <a href="/invite" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.myprofile_show_invite_heading')</a>   
                    </div>                                 
                </div><!-- col-12 end -->
                
               

</div>
 <!--/row-->
</div>

<!-- Edit Section -->
        <div class="tab-pane" id="messages">
            <div class="row"> 
                <div class="col-md-6">
                            <h6>@lang('home.matrimonys_create_personaldetails_fatname') :</h6>
                            <p>
                                {{ old('User_Father_Name', $userprofile->User_Father_Name) }}
                            </p>
                            <h6>@lang('home.matrimonys_create_personaldetails_momname') :</h6>
                            <p>
                            {{ old('User_Mother_Name', $userprofile->User_Mother_Name) }}
                            </p>
                            <h6>@lang('home.myprofile_show_subheading_family_manybro') :</h6>
                            <p>
                            {{ old('User_Brother_Num', $userprofile->User_Brother_Num) }}
                            </p>
                </div>
                <div class="col-md-6">
                            <h6>@lang('home.myprofile_show_subheading_family_manysis') :</h6>
                            <p>
                                {{ old('User_Sister_Num', $userprofile->User_Sister_Num) }}
                            </p>
                            <h6>@lang('home.myprofile_show_subheading_family_native') :</h6>
                            <p>
                                   {{ old('User_Native', $userprofile->User_Native) }}
                            </p>
                </div>
            </div>
      <!--/row-->
  </div>

         <?php if ($userprofile->id == Auth::user()->id )  { ?>
                  <!-- START Family Details -->
                    <div class="tab-pane" id="family">
                    <img src="http://www.tecpleglobal.com/img/family.jpg" alt="Family Tree" class="img-fluid" >
                    </div><!-- END Family Details -->


                            <!-- START  EDIT Details -->
                            <div class="tab-pane" id="edit">
                                    @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>
                                                            {{ $error }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif



                                <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_uname')</label>
                                        <div class="col-lg-9">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_basicdetails_address')</label>
                                        <div class="col-lg-9">
                                              <input id="User_Address" type="text" class="form-control" name="User_Address" value="{{ old('User_Address', auth()->user()->User_Address) }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.footer_sub_head_con_emailaddress')</label>
                                        <div class="col-lg-9">
                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_personal_counryt')</label>
                                        <div class="col-lg-9">
                                                <select id="country" name="User_Country"   onchange="countrycheck()" class="form-control" required>
                                                    <option value="" disabled>Select Country</option>
                                                    <option selected disabled>{{ old('User_Country', $userprofile->Countryname) }}</option> 
                                                   
                                                    @foreach($countries as $key => $country)
                                                    <option value="{{$key}}"> {{$country}}</option>
                                                    @endforeach
                                                    
                                                    @foreach($countries as $key => $country )
                                                      <option value="{{ $key }}" {{ old('User_Country') == $key ? "selected" :""}}>{{$userprofile->Countryname}}</option>
                                                    @endforeach
                                                </select> 
                                         </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_personal_state')</label>
                                        <div class="col-lg-9">
                                                <select name="User_State" id="state"   onchange="statecheck()" class="form-control" required>
                                                    <option  selected disabled>{{ old('User_State', $userprofile->statename) }} </option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.temples_show_city')</label>
                                        <div class="col-lg-9">
                                                <select name="User_City" id="city" class="form-control" required>
                                                      <option selected disabled>{{ old('User_City', $userprofile->cityname) }} </option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_personal_occupation')</label>
                                        <div class="col-lg-9">
                                            
                                            <select name="User_Occupation" class="form-control" required>
                                                   <!-- <option disabled>{{ old('User_City', auth()->user()->User_Occupation) }} </option>
                                                    <option value="Employed">Employed </option>
                                                    <option value="Business">Business </option>
                                                    <option value="Retired">Retired</option>
                                                    <option value="Not Employed">Not Employed </option> usha commented-->
                                                    
                                                    <?php if($userprofile->User_Occupation  != '' && $userprofile->User_Occupation != 'null') { ?>
                                                        <!-- This is only visible (and selected) if it's not Yes or No --->
                                                        <option value="<?php echo $userprofile->User_Occupation ?>" disabled selected ><?php echo $userprofile->User_Occupation ?></option>
                                                    <?php } ?>
                                                    <option value="Employed" <?php if($userprofile->User_Occupation  == 'Employed') { echo 'selected'; } ?> >Employed</option>
                                                    <option value="Business" <?php if($userprofile->User_Occupation  == 'Business') { echo 'selected'; } ?> >Business</option>
                                                    <option value="Retired" <?php if($userprofile->User_Occupation  == 'Retired') { echo 'selected'; } ?> >Retired</option>
                                                    <option value="Not Employed" <?php if($userprofile->User_Occupation  == 'Not Employed') { echo 'selected'; } ?> >Not Employed</option>

                                            </select>
                                               

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_basicdetails_gender')</label>
                                        <div class="col-lg-9">
                                            <select  name="User_Gender" class="form-control" required>
                                                <?php if($userprofile->User_Gender  != '' && $userprofile->User_Gender != 'null') { ?>
                                                   
                                                    <option value="<?php echo $userprofile->User_Gender ?>" disabled selected ><?php echo $userprofile->User_Gender ?></option>
                                                <?php } ?>
                                                <option value="Male" <?php if($userprofile->User_Gender  == 'Male') { echo 'selected'; } ?> >Male</option>
                                                <option value="Female" <?php if($userprofile->User_Gender  == 'Female') { echo 'selected'; } ?> >Female</option>
                                                
                                                <!--@if (Input::old('User_Gender') ==  auth()->user()->User_Gender)
                                                    <option disabled>{{ auth()->user()->User_Gender }} </option>
                                                @else
                                                    <option value="">Select gender</option>
                                                @endif
                                               
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>-->
                                            </select>   
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_basicdetails_marstatus')</label>
                                        <div class="col-lg-9">
                                                <select   name="User_MaritalStatus" class="form-control"  required>
                                                        <!--<option value="" disabled selected>{{ old('User_MaritalStatus', auth()->user()->User_MaritalStatus) }} </option>
                                                        <option value="Single" selected>Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Separated">Separated</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option> 
                                                        -->
                                                        <?php if($userprofile->User_MaritalStatus  != '' && $userprofile->User_MaritalStatus != 'null') { ?>
                                                   
                                                            <option value="<?php echo $userprofile->User_MaritalStatus ?>" disabled  selected ><?php echo $userprofile->User_MaritalStatus ?></option>
                                                        <?php } ?>
                                                        <option value="Single" <?php if($userprofile->User_MaritalStatus  == 'Single') { echo 'selected'; } ?> >Single</option>
                                                        <option value="Married" <?php if($userprofile->User_MaritalStatus  == 'Married') { echo 'selected'; } ?> >Married</option>
                                                        <option value="Separated" <?php if($userprofile->User_MaritalStatus  == 'Separated') { echo 'selected'; } ?> >Separated</option>
                                                        <option value="Divorced" <?php if($userprofile->User_MaritalStatus  == 'Divorced') { echo 'selected'; } ?> >Divorced</option>
                                                        <option value="Widowed" <?php if($userprofile->User_MaritalStatus  == 'Widowed') { echo 'selected'; } ?> >Widowed</option>

                                                </select>   
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_personaldetails_fatname')</label>
                                        <div class="col-lg-9">
                                                <input id="User_Father_Name" type="text" class="form-control" name="User_Father_Name" value="{{ old('User_Father_Name', auth()->user()->User_Father_Name) }}" >
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_personaldetails_momname')</label>  
                                        <div class="col-lg-9">
                                            <input id="User_Mother_Name" type="text" class="form-control" name="User_Mother_Name" value="{{ old('User_Mother_Name', auth()->user()->User_Mother_Name) }}" >
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_family_manybro')</label>
                                        <div class="col-lg-9">
                                                <input id="User_Brother_Num" type="text" class="form-control" name="User_Brother_Num" value="{{ old('User_Brother_Num', auth()->user()->User_Brother_Num) }}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_family_manysis')</label>  
                                        <div class="col-lg-9">
                                                <input id="User_Sister_Num" type="text" class="form-control" name="User_Sister_Num" value="{{ old('User_Sister_Num', auth()->user()->User_Sister_Num) }}" >
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_family_native')</label>  
                                        <div class="col-lg-9">
                                                <input id="User_Native" type="text" class="form-control" name="User_Native" value="{{ old('User_Native', auth()->user()->User_Native) }}" >
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.myprofile_show_subheading_changepro')</label>
                                        <div class="col-lg-9">
                                        <input id="Photo" type="file" class="form-control" name="User_photo" onchange="checkfile()">
                                        <p id="Photo_error" style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">@lang('home.matrimonys_create_basicdetails_mobileno')</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="User_Phone" value="{{ old('Mobile', auth()->user()->User_Phone) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                             <button type="submit" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.myprofile_show_subheading_btn')</button>
                                        </div>
                                    </div>
                             </form>


                         </div><!-- END EDIT -->

                        <?php }  ?>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  


        
<!--  COUNTRY STATE CITY DROPDOWN SCRIPT  -->
<script type="text/javascript">
    function countrycheck() {
    var countryID =  document.getElementById("country").value;
           if(countryID){
                $.ajax({
                  type:"GET",
                  url:"{{url('get-state-list')}}?country_id="+countryID,
                  success:function(res){               
                    if(res){
                        $("#state").empty();
                        $("#state").append('<option value="">Select State</option>');
                        
                        $.each(res,function(key,value){
                            $("#state").append('<option value="'+key+'">'+value+'</option>');
                            
                        });
                  
                    }else{
                      $("#state").empty();
                    }
                  }
                });
            }else{
                $("#state").empty();
                $("#city").empty();
            }      
   }

   

  function statecheck ()
  {
  var stateID = document.getElementById("state").value;   
  if(stateID){
      $.ajax({
         type:"GET",
         url:"{{url('get-city-list')}}?state_id="+stateID,
         success:function(res){               
          if(res){
              $("#city").empty();
              $("#city").append('<option value="">Select City</option>');
              $.each(res,function(key,value){
                  $("#city").append('<option value="'+key+'">'+value+'</option>');
              });
         
          }else{
             $("#city").empty();
          }
         }
      });
  }else{
      $("#city").empty();
  }
      
 }
</script>
<!-- END COUNTRY STATE CITY DROPDOWN SCRIPT  -->


<!--  CASTE SUBCASTE  SCRIPT -->
<script>
        function castemaster() {
          var CasteID =  document.getElementById("caste").value;
          alert("The text has beendocumen changed.");
          if(CasteID){  
              $.ajax({
                 type:"GET",
                 url:"{{url('get-subcaste-list')}}?CasteID="+CasteID,
                 success:function(res){               
                  if(res){
                      $("#subcaste").empty();
                      $("#subcaste").append('<option>Select Subcaste</option>');
                 
                      $.each(res,function(key,value){
                          $("#subcaste").append('<option value="'+key+'">'+value+'</option>');
                          
                      });
                 
                  }else{
                     $("#subcaste").empty();
                  }
                 }
              });
          }else{
              $("#subcaste").empty();
             
          }      
         }
        
          </script>
        <!-- END CASTE SUBCASTE Script  -->
  

        @include('sweetalert::alert')
@endsection
