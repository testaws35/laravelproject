<?php

use Illuminate\Http\Request;
/*For verifying email in Forgot Passowrd feature this is added --start */
use Illuminate\Support\Facades\Password;
/*For verifying email in Forgot Passowrd feature this is added --end */
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*For verifying email in Forgot Passowrd feature this is added --start */
Route::post('/password/reset', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? response()->json(['status' => __($status)])
                : response()->json(['status' => __($status)],406);
})->middleware('guest')->name('password.email');
/*For verifying email in Forgot Passowrd feature this is added --end */

Route::post('payment/status', 'OrderController@paymentCallback');




Route::get('productsonline', 'ProductsOnlineController@index');
Route::get('productsonline/{product}', 'ProductsOnlineController@show');
Route::post('productsonline','ProductsOnlineController@store');
Route::put('productsonline/{product}','ProductsOnlineController@update');
Route::delete('productsonline/{product}', 'ProductsOnlineController@delete');


Route::POST('logout', 'UserrController@logout');
Route::POST('login', 'UserrController@login');

Route::GET('/','WelcomeLandController@index');

Route::get('mobgettamil', 'Auth\MobileController@getlang_library');


Route::get('mobsubcategorylist','Auth\MobileController@subcategorylist');
Route::get('mobsellerlist','Auth\MobileController@sellerlist');

/****************************************************Mobile API ******************************************************************************/
Route::get('mob-userdetails', 'Auth\MobileController@userdetails');

/**************************Login page API **********start ****************************************************************************************/
Route::POST('moblogout', 'Auth\MobileControllerr@logout');
Route::POST('moblogin', 'Auth\MobileController@login');
Route::POST('mobchgpasswd', 'Auth\MobileController@changePassword');
/**************************Login page API **********start ****************************************************************************************/


/**************************Home page API **********start ****************************************************************************************/
Route::POST('/mobhome', 'Auth\MobileController@home_index');
Route::GET('/mobhome', 'Auth\MobileController@home_index');
Route::POST('mobsearch', 'Auth\MobileController@searchApplication');
Route::get('mobsearch', 'Auth\MobileController@searchApplication');

/**************************Home page API **********start ****************************************************************************************/

/**************************Register page API **********start  ****************************************************************************************/

Route::POST('mobregister', 'Auth\MobileController@register');
Route::get('mob-get-subcaste-list','Auth\RegisterController@getSubcasteList');
Route::get('mob-validateInvID', 'Auth\MobileController@mob_regvalidateInvID');
Route::get('mob-get-caste-list','Auth\MobileController@get_castelist');
Route::get('mobcheckUniqueUser','Auth\MobileController@mob_checkUniqueUser');
Route::get('checkUniqueUserEmail/','InviteController@checkUniqueUserEmail');
/**************************MyProfile page API **********start  ****************************************************************************************/
Route::get('mobprofile', 'Auth\MobileController@showaccountpage');
Route::post('mobprofile-edit', 'Auth\MobileController@mob_updateProfile');
Route::post('mobedit_profileimage', 'Auth\MobileController@edit_profileimage');

/**************************Product page API **********start  ****************************************************************************************/

Route::get('mobjwellery_index', 'Auth\MobileController@jwellery_index');
Route::get('mobjwellery_show/{ProductID}', 'Auth\MobileController@product_show');
Route::post('mobjwellery_store','Auth\MobileController@mob_product_store');
Route::post('mobproducts_update','Auth\MobileController@mob_pro_update');
Route::get('mobproducts_delete/{ProductID}','Auth\MobileController@mob_product_destroy');
Route::get('mobproducts_edit/{ProductID}','Auth\MobileController@mob_product_edit');

/**********************************************************************************************************************************************/
/***********************************Temple Functions page API  ************* Start ************************************************************/
Route::get('mobtemplefunction','Auth\MobileController@templefunctn_index');
Route::get('mobtemplelist', 'Auth\MobileController@templeslist');
Route::post('mobtemplefunc_store', 'Auth\MobileController@templefun_store');
Route::get('mobtemplefunc_show/{TempleFunctionID}', 'Auth\MobileController@templefunc_show'); 
Route::get('mobtemplefunc_edit/{TempleFunctionID}', 'Auth\MobileController@templefunc_edit');
Route::post('mobtemplefunc_update', 'Auth\MobileController@templefunctn_update');   
Route::get('mobtemplefunctn_destroy/{TempleFunctionID}', 'Auth\MobileController@templefunctn_destroy');
/***********************************Temple Functions page API  ************* End **************************************************************/
/***********************************Announcements page API  ************* Start ***************************************************************/
Route::get('mobannouncement','Auth\MobileController@announcement_index');
Route::post('mobannounc_store','Auth\MobileController@Announcement_store');
Route::get('mobannounc_show/{AnnouncementsID}','Auth\MobileController@Announcements_show');
Route::get('mobannounc_edit/{announcementsID}','Auth\MobileController@announcements_edit');
Route::post('mobannounc_update','Auth\MobileController@announcement_update');
Route::get('mobannounc_delete/{AnnouncementsID}','Auth\MobileController@announcement_destroy');
/***********************************Announcements page API  *************End*******************************************************************/
/***********************************Community page API  ************* Start *******************************************************************/
//sangam api start
Route::get('mobcommunity_sangam', 'Auth\MobileController@mob_community_sangam');
Route::post('mobcommunity_sangamstore', 'Auth\MobileController@mob_community_sangamstore');
//temples api start
Route::get('mobcommunity_temples', 'Auth\MobileController@mob_community_temples');
Route::post('mobcommunity_templestore', 'Auth\MobileController@mob_community_templestore');
//sellers api start
Route::get('mobcommunity_sellers', 'Auth\MobileController@mob_community_sellers');
Route::get('mobcommunity_sellersdate', 'Auth\MobileController@mob_comm_sellerdatefilter');
Route::get('/get/razor/payment/{paymentId}', 'RazorpayController@getRazorPaymentDetails');
Route::get('mobrazorpay_user_details', 'Auth\MobileController@getrazorpay_user_details');
Route::post('mobseller_store', 'Auth\MobileController@mobseller_store');
Route::get('mobseller_edit_show/{sellerID}','Auth\MobileController@mob_comm_selleredit');
Route::post('mobseller_update', 'Auth\MobileController@mob_comm_sellerupdate');
Route::get('mobseller_destroy/{sellerID}', 'Auth\MobileController@mob_comm_sellerdestroy');
/***********************************Community page API  ************* End ********************************************************************/
/***********************************Sangam meetings Functions page API  ************* Start ************************************/
Route::get('mobsangam_meetings', 'Auth\MobileController@mobsangam_index');
Route::post('mobsangam_meetings_add', 'Auth\MobileController@mobsangam_store');
Route::get('mobsangam_meetings_show/{SangamMeetingID}', 'Auth\MobileController@mobsangam_show');
Route::get('mobsangam_meetings_edit/{SangamMeetingID}', 'Auth\MobileController@mobsangam_edit');
Route::post('mobsangam_meetings_update', 'Auth\MobileController@mobsangam_update');
Route::get('mobsangam_meetings_destroy/{SangamMeetingID}', 'Auth\MobileController@mobsangam_destroy');
/***********************************Sangam meetings Functions page API  ************* End **************************************/

/***********************************Personal Functions page API  ******************** Start ************************************/
Route::get('mobpersonalfunctions', 'Auth\MobileController@mobpersonalfun_index');
Route::post('mobpersonalfunc_add', 'Auth\MobileController@mobpersonalfunc_store');
Route::get('mobpersonalfunc_show/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_show');
Route::get('mobpersonalfunc_edit/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_edit');
Route::post('mobpersonalfunc_update', 'Auth\MobileController@mobpersonalfunc_update');
Route::get('mobpersonalfunc_destroy/{PersonalFunctionID}', 'Auth\MobileController@mobpersonalfunc_destroy');
/***********************************Personal Functions page API  ************* End **************************************/
/***********************************helppost  Controller page API  ************* Start **************************************/

Route::get('mobhelppost', 'Auth\MobileController@helppost_index');
Route::post('mobhelppost_store', 'Auth\MobileController@helppost_store');
Route::get('mobhelppost_show/{HelpID}', 'Auth\MobileController@helppost_show');
Route::get('mobhelppost_edit/{HelpID}', 'Auth\MobileController@helppost_edit');
Route::post('mobhelppost_update', 'Auth\MobileController@helppost_update');
Route::get('mobhelppost_destroy/{HelpID}', 'Auth\MobileController@helppost_destroy');
Route::get('mobhelppost_getCat/{cat}', 'Auth\MobileController@helppost_getCat');
/***********************************helppost  Controller page API  ************* end **************************************/
/***********************************Elders  Controller page API  ************* Start **************************************/
Route::get('mobelders_index', 'Auth\MobileController@elders_index');
Route::post('mobelderstore', 'Auth\MobileController@elderstore');
Route::get('mobeldersshow/{FAQ_PostID}', 'Auth\MobileController@eldersshow');
Route::post('mobElder_IVolunteer', 'Auth\MobileController@Elder_IVolunteer');
Route::post('mobeldercomment_store', 'Auth\MobileController@eldercomment_store');

/***********************************Elders  Controller page API  ************* End **************************************/
Route::post('mobcontactUSPost', 'Auth\MobileController@mobcontactUSPost');

Route::post('mobcommentstore', 'Auth\MobileController@commentstore');

Route::get('mobcountries_list', 'Auth\MobileController@countries_list');
Route::get('mobcity_list', 'Auth\MobileController@city_list');
Route::get('mobstate_list', 'Auth\MobileController@state_list');


Route::post('mob_sendingInvite', 'Auth\MobileController@mob_sendingInvite');


Route::get('mobmatrimony_index', 'Auth\MobileController@matrimony_index');
Route::post('mobmatrimony_store', 'Auth\MobileController@matrimony_store');
Route::get('mobmatrimony_show/{RegistrationID}', 'Auth\MobileController@matrimony_show');
Route::get('mobmatrimony_edit/{RegistrationID}', 'Auth\MobileController@matrimony_edit');
Route::post('mobmatrimony_update', 'Auth\MobileController@matrimony_update');
Route::get('mobmatrimony_delete/{RegistrationID}/{UserID}', 'Auth\MobileController@matrimony_delete');

Route::get('mobgetSubcasteList', 'Auth\MobileController@mobgetSubcasteList');

Route::POST('mob_setMatrimonyExpiry', 'Auth\MobileController@mob_setMatrimonyExpiry');
