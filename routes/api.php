<?php



use Illuminate\Http\Request;



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



Route::group(['namespace'=> 'Api'], function(){

    /*

    api mate na route aya specify karvana ok

    alag controller use thato hoi tya api na folder ma alag controller ma method bnavi devani

    */

    Route::post('facebook','UserController@facebook');

    Route::post('registration','UserController@registration');

    Route::post('login', 'UserController@login');

    Route::post('forgotpassword', 'UserController@forgot_password');

    Route::post('login_wp', 'UserController@login_wp');

    Route::post('token',"UserController@token");

    Route::group(['middleware' => 'jwt.auth'], function(){



    Route::post('changepassword','UserController@changepassword');    

    Route::post('employee','UserController@employee');

    Route::post('service', 'UserController@service');
    Route::post('service_id', 'UserController@service_id');
    Route::post('employee_id', 'UserController@employee_id');
    Route::post('category_service', 'UserController@category_service');

    Route::post('appointment','UserController@appointment');

    Route::post('userpoint','UserController@userpoint');

    Route::post('userdata','UserController@userdata');

    Route::post('category','UserController@category');
    Route::post('setting','UserController@setting');
    Route::post('product','UserController@product');
    Route::post('logout',"UserController@logoutApi");
    Route::post('gallary',"UserController@gallary");
    Route::post('before_after',"UserController@before_after");
    Route::post('timeslot',"UserController@timeslot");
    Route::post('otherStuff',"UserController@otherStuff");
    
        

    }); 

});