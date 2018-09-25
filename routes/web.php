<?php



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



Route::get('/', function () {

    return view('login.index');

});







/*login*/

Route::group(['middleware'=> ['auth','webuser']], function(){

    

    /*employee*/

    Route::get('employee', 'EmployeeController@index');
    Route::get('employee/create', 'EmployeeController@create');
    Route::post('employee', 'EmployeeController@store');
    Route::get('employee/edit/{id}', 'EmployeeController@edit');
    Route::post('employee/{id}', 'EmployeeController@update');
    Route::get('employee/delete/{id}', 'EmployeeController@delete');
    Route::get('employee/timeslot/{id}', 'EmployeeController@timeslot');
    Route::get('employee/deletemul', 'EmployeeController@deletemul');


    /*service*/

    Route::get('service', 'ServiceController@index');
    Route::get('service/create', 'ServiceController@create');
    Route::post('service', 'ServiceController@store');
    Route::get('service/edit/{id}', 'ServiceController@edit');
    Route::post('service/{id}', 'ServiceController@update');
    Route::get('service/delete/{id}', 'ServiceController@delete');
    Route::get('service/deletemul', 'ServiceController@deletemul');
   

    /*appointment*/

    Route::get('appointment', 'AppointmentController@index');
    Route::get('appointment/create', 'AppointmentController@create');
    Route::post('appointment', 'AppointmentController@store');
    Route::get('appointment/edit/{id}', 'AppointmentController@edit');
    Route::post('appointment/{id}', 'AppointmentController@update');
    Route::get('appointment/delete/{id}', 'AppointmentController@delete');
    Route::get('appointment/view/{id}', 'AppointmentController@view');
    Route::get('appointment/employee/{id}', 'AppointmentController@employee');
    Route::get('appointment/appointment_time/{id}', 'AppointmentController@appointment_time');
    Route::get('appointment/deletemul', 'AppointmentController@deletemul');
    Route::get('appointment/interval', 'AppointmentController@interval');


    /*employee service*/

    /*Route::get('employeeService', 'employee_serviceController@index');

    Route::get('employeeService/create', 'employee_serviceController@create');

    Route::post('employeeService', 'employee_serviceController@store');

    Route::get('employeeService/edit/{id}', 'employee_serviceController@edit');

    Route::post('employeeService/{id}', 'employee_serviceController@update');

    Route::get('employeeService/delete/{id}', 'employee_serviceController@delete');
*/


    /*complete appointment*/

    Route::get('complete_appointment', 'CompleteAppointmentController@index');
    Route::get('complete_appointment/deletemul', 'CompleteAppointmentController@deletemul');

    /*category*/

    Route::get('category', 'CategoryController@index');
    Route::get('category/create', 'CategoryController@create');
    Route::post('category', 'CategoryController@store');
    Route::get('category/edit/{id}', 'CategoryController@edit');
    Route::post('category/{id}', 'CategoryController@update');
    Route::get('category/delete/{id}', 'CategoryController@delete');
    Route::get('category/deletemul', 'CategoryController@deletemul');

/*product*/

    Route::get('product', 'ProductController@index');
    Route::get('product/create', 'ProductController@create');
    Route::post('product', 'ProductController@store');
    Route::get('product/edit/{id}', 'ProductController@edit');
    Route::post('product/{id}', 'ProductController@update');
    Route::get('product/delete/{id}', 'ProductController@delete');
    Route::get('product/deletemul', 'ProductController@deletemul');

    /*dashboard*/

    Route::get('dashboard', 'DashboardController@index');

    /*timeslot*/

    Route::get('timeslot', 'TimeslotController@index');
    Route::get('timeslot/create', 'TimeslotController@create');
    Route::post('timeslot', 'TimeslotController@store');
    Route::post('timeslot', 'TimeslotController@status');

    /*customer*/

    Route::get('customer', 'CustomerController@index');
    Route::get('customer/create', 'CustomerController@create');
    Route::post('customer', 'CustomerController@store');
    Route::get('customer/edit/{id}', 'CustomerController@edit');
    Route::post('customer/{id}', 'CustomerController@update');
    Route::get('customer/delete/{id}', 'CustomerController@delete');
    Route::get('serch', 'CustomerController@serch');
    Route::get('export', 'CustomerController@export');
    Route::get('pdf', 'CustomerController@pdf');
   
    /*setting*/
    Route::get('setting', 'SettingController@index');
    Route::post('setting/store', 'SettingController@store');

    /*gallary*/
    Route::get('gallary', 'GallaryController@index');
    Route::get('gallary/create', 'GallaryController@create');
    Route::post('gallary', 'GallaryController@store');
    Route::get('gallary/edit/{id}', 'GallaryController@edit');
    Route::post('gallary/{id}', 'GallaryController@update');
    Route::get('gallary/delete/{id}', 'GallaryController@delete');
    Route::get('gallary/deletemul', 'GallaryController@deletemul');
   
    /*before_after*/
    Route::get('before_after', 'BeforeAfterController@index');
    Route::get('before_after/create', 'BeforeAfterController@create');
    Route::post('before_after', 'BeforeAfterController@store');
    Route::get('before_after/edit/{id}', 'BeforeAfterController@edit');
    Route::post('before_after/{id}', 'BeforeAfterController@update');
    Route::get('before_after/delete/{id}', 'BeforeAfterController@delete');
    Route::get('before_after/deletemul', 'BeforeAfterController@deletemul');
});

Auth::routes();





