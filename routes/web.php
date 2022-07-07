<?php

use RealRashid\SweetAlert\Facades\Alert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/**  To avoid below error
 *             "count-parameter-must-be-an-array-or-an-object-that-implements-countable"  
 *  due to usage of count function in controller
 * the below if statement is added
 * 
 */

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


//this is for upload image to work in production server
Route::get('/any-route', function () {
    Artisan::call('storage:link');
  });

/** START Products Feature */
Route::get('myform/ajax/{SubCategoryID}','ProductController@myformAjax');
Route::get('product_subcategories/{ProductID}','ProductController@showSubCates');
Route::resource('products','ProductController');
Route::get('products','ProductController@index')->name('products.index');
Route::get('products/index/{subCategoryID}','ProductController@index');

//Route::resource('sellers','SellerController');
Route::get('sellers','SellerController@index')->name('sellers');

Route::get('sellers/index','SellerController@index')->name('sellers.index');
Route::post('sellers/store','SellerController@store')->name('sellers.store');
Route::get('sellers/show/{sellerID}','SellerController@show')->name('sellers.show');
Route::get('sellers/create','SellerController@create')->name('sellers.create');
Route::get('sellers/destroy/{sellerID}','SellerController@destroy')->name('sellers.destroy');
Route::get('sellers/edit/{sellerID}','SellerController@edit')->name('sellers.edit');
Route::post('sellers/update','SellerController@update')->name('sellers.update');

Route::get('get-subcategory-list','ProductController@getSubcategoryList');
Route::get('products/edit/{ProductID}','ProductController@edit')->name('products.edit');
Route::get('products/destroy/{ProductID}','ProductController@destroy')->name('products.destroy');
Route::POST('products/update','ProductController@update')->name('products.update');

/** END Products Feature */


Route::get('/get/razor/payment/{paymentId}', 'RazorpayController@getRazorPaymentDetails')->name('get_razor_pay_details');


/** START AUTH */
Auth::routes(['verify' => true]);
/** END AUTH */


/** START HOME PAGE */
Route::POST('/home', 'HomeController@index')->name('home');
Route::GET('/home', 'HomeController@index')->name('home');
Route::GET('/home/search', 'HomeController@searchApplication')->name('search');
Route::POST('/home/search', 'HomeController@searchApplication')->name('search');
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('logout', 'UserController@logout');

//Aruna added this
Route::POST('logout', 'UserController@logout')->name('logout');
Route::POST('login', 'UserController@login')->name('login');


Route::get('/getprofile', 'UserController@getprofile');
Route::get('/education', 'WelcomeController@education');

//Route::post('/', ['as'=>'contactusland.store','uses'=>'WelcomeController@contactUSLandPost']);
/*Route::GET('contactusland','WelcomeController@contactUSLandPost')->name('contactusland');*/

/**Route::post('contactusland', 'ContactUSController@contactUSPost_Welcome')->name('contactusland');**/
Route::post('contactusland', 'WelcomeController@contactUSLandPost')->name('contactusland');



/** END HOME PAGE */



/** START Registration Page */
Route::resource('register','Auth\RegisterController');
Route::get('register','Auth\RegisterController@index')->name('register');
Route::get('checkUniqueUser/','Auth\RegisterController@checkUniqueUser')->name('checkUniqueUser');
Route::get('checkUniqueUserEmail/','InviteController@checkUniqueUserEmail')->name('checkUniqueUserEmail');


Route::POST('store','Auth\RegisterController@store')->name('register.store');
Route::get('get-subcaste-list','Auth\RegisterController@getSubcasteList');
Route::get('validateinvitationID','Auth\RegisterController@validateInvID')->name('validateinvitationID');

/** END Registration Page */
 


/* START  User Profile Page  */
Route::get('get-state-list','ProfileController@getStateList');
Route::get('get-city-list','ProfileController@getCityList');
Route::get('/profile/{id}', 'ProfileController@index')->name('profile.index');
Route::post('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
Route::put('/updateAuthUserPassword','ProfileController@updateAuthUserPassword');
/* END  User Profile Page */


/* START  Login with OTP  */
Route::post('loginWithOtp', 'UserController@loginWithOtp')->name('loginWithOtp');
Route::get('loginWithOtp', function () {
                            return view('auth/OtpLogin');
                        })->name('loginWithOtp'); 
Route::post('sendOtp', 'UserController@sendOtp');
Route::post('newregister', 'UserController@register')->name('newregister');
/* END Login with OTP */



/** START Pages Control */
 Route::get('/community', 'PagesController@community')->name('community');
 Route::get('/registerasseller', 'PagesController@registerasseller');
 Route::get('/onlinePay', 'PagesController@onlinePay')->name('onlinePay');
 Route::post('payment', 'PagesController@payment')->name('payment');

/** END Pages Control */


/*  Start Locale */
 Route::get('locale/{locale}',function($locale){
	Session::put('locale',$locale);
	return redirect()->back();
	/*  This link will add session of lang when they click to change language */
});
/*  End Locale */



/* START Sangam Meetings */
Route::resource('sangammeetings','SangamMeetingsController');
Route::get('/sangammeetings/show/{SangamMeetingID}', 'SangamMeetingsController@show')->name('sangammeetings.show');
Route::get('/sangammeetings/edit/{SangamMeetingID}', 'SangamMeetingsController@edit')->name('sangammeetings.edit');
Route::POST('/sangammeetings/update', 'SangamMeetingsController@update')->name('sangammeetings.update');
Route::POST('/sangammeetings/destroy', 'SangamMeetingsController@destroy')->name('sangammeetings.destroy');
/* END Sangam Meetings */



/* START Temple Functions  */
Route::resource('templefunctions','TempleFunctionsController');
//Route::get('templefunctions/index/{templeid}','TempleFunctionsController@index');
Route::get('/templefunctions/show/{TempleFunctionID}', 'TempleFunctionsController@show')->name('templefunctions.show');
Route::get('/templefunctions/edit/{TempleFunctionID}', 'TempleFunctionsController@edit')->name('templefunctions.edit');
Route::POST('/templefunctions/update', 'TempleFunctionsController@update')->name('templefunctions.update');
Route::get('/templefunctions/delete/{TempleFunctionID}', 'TempleFunctionsController@destroy')->name('templefunctions.delete');
/* END Temple Functions  */



/* START Personal Functions  */
Route::resource('personalfunctions','PersonalFunctionsController');
//Route::resource('personalfunctions/index','PersonalFunctionsController@index');
Route::get('/personalfunctions/show/{PersonalFunctionID}', 'PersonalFunctionsController@show')->name('personalfunctions.show');
Route::get('/personalfunctions/edit/{PersonalFunctionID}', 'PersonalFunctionsController@edit')->name('personalfunctions.edit');
Route::POST('/personalfunctions/update', 'PersonalFunctionsController@update')->name('personalfunctions.update');
Route::get('personalfunctions/destroy/{PersonalFunctionID}','PersonalFunctionsController@destroy')->name('personalfunctions.destroy');
/* END Personal Functions  */



/* START Announcements */
Route::resource('announcements','AnnouncementsController');
Route::get('/announcements/show/{AnnouncementsID}', 'AnnouncementsController@show')->name('announcements.show');
Route::get('/announcements/edit/{AnnouncementsID}', 'AnnouncementsController@edit')->name('announcements.edit');
Route::POST('/announcements/update', 'AnnouncementsController@update')->name('announcements.update');
Route::get('/announcements/delete/{AnnouncementsID}', 'AnnouncementsController@destroy')->name('announcements.delete');

/* END Announcements */




/* START FAQ */
Route::resource('elders','ElderDetailsController');
Route::get('/elders/show/{ElderID}', 'ElderDetailsController@show')->name('elders.show');
Route::POST('/elders/volunteer', 'ElderDetailsController@IVolunteer')->name('elders.volunteer');
Route::post('/faqcomment/store', 'CommentController@store')->name('faqcomment.add');
/* END FAQ   */



/* START  HELP POST & COMMENTS */
Route::resource('helpposts','HelpPostController');
Route::post('/comment/store', 'HelpCommentController@store')->name('comment.add');
Route::post('/helpposts/create', 'HelpPostController@store')->name('helpposts.create');
Route::get('/helpposts/destroy/{HelpID}', 'HelpPostController@destroy')->name('helpposts.destroy');

Route::get('/helpposts/show/{HelpID}', 'HelpPostController@show')->name('helpposts.show');
Route::get('/helpposts/getCat/{cat}', 'HelpPostController@getCat')->name('helpposts.getCat');
Route::post('/helpposts/update', 'HelpPostController@update')->name('helpposts.update');


/* END  HELP POST & COMMENTS */



/* START  MATRIMONYS */
Route::resource('matrimonys','MatrimonyController');
Route::post('/matrimonys/index', 'MatrimonyController@index')->name('matrimonys');
Route::post('/matrimonys/store', 'MatrimonyController@store')->name('matrimonys.store');
Route::get('get-subcast-lst','MatrimonyController@getSubcasteList');
Route::post('/matrimonys/update/{RegistrationID}', 'MatrimonyController@update')->name('matrimonys.update');
Route::post('/matrimonys/create', 'MatrimonyController@create')->name('matrimonys.create');
Route::get('/matrimonys/delete/{RegistrationID}', 'MatrimonyController@delete')->name('matrimonys.delete');
Route::get('/onlinePay', 'MatrimonyController@onlinePay')->name('onlinePay');
Route::POST('/setMatrimonyExpiry', 'MatrimonyController@setMatrimonyExpiry')->name('setMatrimonyExpiry');
Route::GET('/setMatrimonyExpiry', 'MatrimonyController@setMatrimonyExpiry');
// Post Route For Make Payment Request using Razorpay payment gateway
Route::post('payment', 'MatrimonyController@payment')->name('payment');
/* END  MATRIMONYS */



/* START Establishments */
Route::resource('sangams','SangamMasterController');
Route::get('/sangams/show/{SangamID}', 'SangamMasterController@show')->name('sangams.show');
Route::resource('temples','TempleMasterController');
Route::get('/temples/show/{TempleID}', 'TempleMasterController@show')->name('temples.show');
/* END Establishments */



/*  START Registration SECTION  */
Route::get('invite', 'InviteController@invite')->name('invite');
Route::post('sendinvite', 'InviteController@sendingInvite')->name('sendinvite');

// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{invitationid}', 'InviteController@show')->name('accept');
//Route::get('checkInvite/{invitationid}', 'InviteController@checkInvite');
Route::get('get-checkinvite-list','InviteController@checkInvite');
/*  END Registration SECTION   */


/* Contact Us */
Route::get('contact-us', 'ContactUSController@contactUS');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);
/* Contact Us */


/****************************************************Mobile API ******************************************************************************/

Route::get('mob-userdetails', 'Auth\MobileController@userdetails')->name('mob-userdetails');

/*****************************************************Registration API***********start**********************************************/
Route::get('mob-validateInvID', 'Auth\MobileController@validateInvID')->name('mob-validateInvID');
Route::POST('mobregister', 'Auth\MobileController@register')->name('mobregister');
Route::get('mobcheckUniqueUser','Auth\MobileController@mob_checkUniqueUser')->name('mobcheckUniqueUser');

/*****************************************************Registration API***********start**********************************************/




/**************************Home page API **********start ****************************************************************************************/
Route::POST('/mobhome', 'Auth\MobileController@home_index')->name('mobhome');
Route::GET('/mobhome', 'Auth\MobileController@home_index')->name('mobhome');
Route::get('mobsearch', 'Auth\MobileController@searchApplication')->name('mobsearch');

Route::POST('mobsearch', 'Auth\MobileController@searchApplication')->name('mobsearch');
/**************************Home page API **********end  ****************************************************************************************/


/**************************Login page API **********start  ****************************************************************************************/

Route::POST('moblogout', 'Auth\MobileController@logout')->name('moblogout');
Route::POST('moblogin', 'Auth\MobileController@login')->name('moblogin');
Route::POST('mobchgpasswd', 'Auth\MobileController@changePassword')->name('mobchgpasswd');

/**************************Login page API **********end  ****************************************************************************************/


/**************************Profile page API **********start  ***********************************************************************************/
Route::get('mobprofile', 'Auth\MobileController@showaccountpage')->name('mobprofile');
Route::post('mobprofile-edit', 'Auth\MobileController@mob_updateProfile')->name('mobprofile-edit');
Route::post('mobedit_profileimage', 'Auth\MobileController@edit_profileimage')->name('mobedit_profileimage');

/**************************Profile page API ********** end  ************************************************************************************/

/**********************************************Jwellery/Product page api ***************start***************************************************/
Route::get('mobjwellery_index', 'Auth\MobileController@jwellery_index')->name('mobjwellery_index');
Route::get('mobjwellery_show/{ProductID}', 'Auth\MobileController@product_show')->name('mobjwellery_show');
Route::post('mobjwellery_store','Auth\MobileController@mob_product_store')->name('mobjwellery_store');
Route::post('mobproducts_update','Auth\MobileController@mob_pro_update')->name('mobproducts_update');
Route::get('mobproducts_delete/{ProductID}','Auth\MobileController@mob_product_destroy')->name('mobproducts_delete');
Route::get('mobproducts_edit/{ProductID}','Auth\MobileController@mob_product_edit')->name('mobproducts_edit');
Route::get('mobsubcategorylist','Auth\MobileController@subcategorylist')->name('mobsubcategorylist');
Route::get('mobsellerlist','Auth\MobileController@sellerlist')->name('mobsellerlist');

/**********************************************Jwellery/Product page api ***************end***************************************************/

/***********************************Temple Functions page API  ************* Start ***********************************************************/
Route::get('mobtemplefunction','Auth\MobileController@templefunctn_index')->name('mobtemplefunction');
Route::get('mobtemplelist', 'Auth\MobileController@templeslist')->name('mobtemplelist');
Route::post('mobtemplefunc_store', 'Auth\MobileController@templefun_store')->name('mobtemplefunc_store');
Route::get('mobtemplefunc_show/{TempleFunctionID}', 'Auth\MobileController@templefunc_show')->name('mobtemplefunc_show'); 
Route::get('mobtemplefunc_edit/{TempleFunctionID}', 'Auth\MobileController@templefunc_edit')->name('mobtemplefunc_edit');
Route::post('mobtemplefunc_update', 'Auth\MobileController@templefunctn_update')->name('mobtemplefunc_update');
Route::get('mobtemplefunctn_destroy/{TempleFunctionID}', 'Auth\MobileController@templefunctn_destroy')->name('mobtemplefunctn_destroy');

/***********************************Temple Functions page API  ************* End *************************************************************/

/***********************************Announcements page API  ************* Start **************************************************************/
Route::get('mobannouncement','Auth\MobileController@announcement_index')->name('mobannouncement');
Route::post('mobannounc_store','Auth\MobileController@Announcement_store')->name('mobaannounc_store');
Route::get('mobannounc_show/{AnnouncementsID}','Auth\MobileController@Announcements_show')->name('mobannounc_show');
Route::get('mobannounc_edit/{announcementsID}','Auth\MobileController@announcements_edit')->name('mobannounc_edit');
Route::post('mobannounc_update','Auth\MobileController@announcement_update')->name('mobannounc_update');
Route::get('mobannounc_delete/{AnnouncementsID}','Auth\MobileController@announcement_destroy')->name('mobannounc_delete');
/***********************************Announcements page API  ************* Start **************************************************************/

/***********************************Community page API  ************* Start **************************************************************/
//community sangam api start
Route::get('mobcommunity_sangam', 'Auth\MobileController@mob_community_sangam')->name('mobcommunity_sangam');
Route::post('mobcommunity_sangamstore', 'Auth\MobileController@mob_community_sangamstore')->name('mobcommunity_sangamstore');
//community temple api start
Route::get('mobcommunity_temples', 'Auth\MobileController@mob_community_temples')->name('mobcommunity_temples');
Route::post('mobcommunity_templestore', 'Auth\MobileController@mob_community_templestore')->name('mobcommunity_templestore');
//sellers api start
Route::get('mobcommunity_sellers', 'Auth\MobileController@mob_community_sellers')->name('mobcommunity_sellers');
Route::get('mobcommunity_sellersdate', 'Auth\MobileController@mob_comm_sellerdatefilter')->name('mobcommunity_sellersdate');
Route::post('mobseller_store', 'Auth\MobileController@mobseller_store')->name('mobseller_store');
Route::get('mobseller_edit_show/{sellerID}','Auth\MobileController@mob_comm_selleredit')->name('mobseller_edit_show');
Route::post('mobseller_update', 'Auth\MobileController@mob_comm_sellerupdate')->name('mobseller_update');
Route::get('mobseller_destroy/{sellerID}', 'Auth\MobileController@mob_comm_sellerdestroy')->name('mobseller_destroy');
/***********************************Community page API  ************* End **************************************************************/

/***********************************Sangam meetings Functions page API  ************* Start ************************************/
Route::get('mobsangam_meetings', 'Auth\MobileController@mobsangam_index')->name('mobsangam_meetings');
Route::post('mobsangam_meetings_add', 'Auth\MobileController@mobsangam_store')->name('mobsangam_meetings_add');
Route::get('mobsangam_meetings_show/{SangamMeetingID}', 'Auth\MobileController@mobsangam_show')->name('mobsangam_meetings_show');
Route::get('mobsangam_meetings_edit/{SangamMeetingID}', 'Auth\MobileController@mobsangam_edit')->name('mobsangam_meetings_edit');
Route::post('mobsangam_meetings_update', 'Auth\MobileController@mobsangam_update')->name('mobsangam_meetings_update');
Route::get('mobsangam_meetings_destroy/{SangamMeetingID}', 'Auth\MobileController@mobsangam_destroy')->name('mobsangam_meetings_destroy');
/***********************************Sangam meetings Functions page API  ************* End **************************************/

/***********************************Personal Functions page API  ******************** Start ************************************/
Route::get('mobpersonalfunctions', 'Auth\MobileController@mobpersonalfun_index')->name('mobpersonalfunctions');
Route::post('mobpersonalfunc_add', 'Auth\MobileController@mobpersonalfunc_store')->name('mobpersonalfunc_add');
Route::get('mobpersonalfunc_show/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_show')->name('mobpersonalfunc_show');
Route::get('mobpersonalfunc_edit/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_edit')->name('mobpersonalfunc_edit');
Route::post('mobpersonalfunc_update', 'Auth\MobileController@mobpersonalfunc_update')->name('mobpersonalfunc_update');
Route::get('mobpersonalfunc_destroy/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_destroy')->name('mobpersonalfunc_destroy');
/***********************************Personal Functions page API  ************* End **************************************/
/***********************************helppost  Controller page API  ************* Start **************************************/

Route::get('mobhelppost', 'Auth\MobileController@helppost_index')->name('mobhelppost');
Route::post('mobhelppost_store', 'Auth\MobileController@helppost_store')->name('mobhelppost_store');
Route::get('mobhelppost_show/{HelpID}', 'Auth\MobileController@helppost_show')->name('mobhelppost_show');
Route::get('mobhelppost_edit/{HelpID}', 'Auth\MobileController@helppost_edit')->name('mobhelppost_edit');
Route::post('mobhelppost_update', 'Auth\MobileController@helppost_update')->name('mobhelppost_update');
Route::get('mobhelppost_destroy/{HelpID}', 'Auth\MobileController@helppost_destroy')->name('mobhelppost_destroy');
Route::get('mobhelppost_getCat/{cat}', 'Auth\MobileController@helppost_getCat')->name('mobhelppost_getCat');
/***********************************helppost  Controller page API  ************* end **************************************/
/***********************************Elders  Controller page API  ************* Start **************************************/

Route::get('mobelders_index', 'Auth\MobileController@elders_index')->name('mobelders_index');
Route::post('mobelderstore', 'Auth\MobileController@elderstore')->name('mobelderstore');
Route::get('mobeldersshow/{FAQ_PostID}', 'Auth\MobileController@eldersshow')->name('mobeldersshow');
Route::post('mobElder_IVolunteer', 'Auth\MobileController@Elder_IVolunteer')->name('mobElder_IVolunteer');
Route::post('mobeldercomment_store', 'Auth\MobileController@eldercomment_store')->name('mobeldercomment_store');

/***********************************Elders  Controller page API  ************* End **************************************/
Route::post('mobcontactUSPost', 'Auth\MobileController@mobcontactUSPost')->name('mobcontactUSPost');


Route::post('mobcommentstore', 'Auth\MobileController@commentstore')->name('mobcommentstore');
Route::get('mobrazorpay_user_details', 'Auth\MobileController@getrazorpay_user_details')->name('mobrazorpay_user_details');





Route::get('mobmatrimony_index', 'Auth\MobileController@matrimony_index')->name('mobmatrimony_index');
Route::post('mobmatrimony_store', 'Auth\MobileController@matrimony_store')->name('mobmatrimony_store');
Route::get('mobmatrimony_show/{RegistrationID}', 'Auth\MobileController@matrimony_show')->name('mobmatrimony_show');
Route::get('mobmatrimony_edit/{RegistrationID}', 'Auth\MobileController@matrimony_edit')->name('mobmatrimony_edit');
Route::post('mobmatrimony_update', 'Auth\MobileController@matrimony_update')->name('mobmatrimony_update');
Route::get('mobmatrimony_delete/{RegistrationID}/{UserID}', 'Auth\MobileController@matrimony_delete')->name('mobmatrimony_delete');
Route::get('mobgetSubcasteList', 'Auth\MobileController@mobgetSubcasteList')->name('mobgetSubcasteList');

Route::get('mobgettamil', 'Auth\MobileController@getlang_library')->name('mobgettamil');

Route::post('mob_sendingInvite', 'Auth\MobileController@mob_sendingInvite')->name('mob_sendingInvite');



Route::get('mobcountries_list', 'Auth\MobileController@countries_list')->name('mobcountries_list');
Route::get('mobcity_list', 'Auth\MobileController@state_list')->name('mobcity_list');
Route::get('mobstate_list', 'Auth\MobileController@city_list')->name('mobstate_list'); 

