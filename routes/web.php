<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'WelcomeController@welcome')->name('welcome');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/accomodation', 'HomeController@accomodation')->name('accomodation');
Route::get('/accomodation_type', 'HomeController@accomodation_type')->name('accomodation_type');
Route::post('/accomodation_type_process', 'HomeController@accomodation_type_process')->name('accomodation_type_process');
Route::post('/accomodation_type_edit_process', 'HomeController@accomodation_type_edit_process')->name('accomodation_type_edit_process');
Route::post('/accomodation_process', 'HomeController@accomodation_process')->name('accomodation_process');
Route::get('/accomodation_list', 'HomeController@accomodation_list')->name('accomodation_list');
Route::get('/about', 'HomeController@about')->name('about');
Route::post('/about_process', 'HomeController@about_process')->name('about_process');
Route::get('/carousel', 'HomeController@carousel')->name('carousel');
Route::get('/message', 'HomeController@message')->name('message');
Route::post('/message_process', 'HomeController@message_process')->name('message_process');
Route::get('/reservations', 'HomeController@reservations')->name('reservations');
Route::post('/reservation_process_data', 'HomeController@reservation_process_data')->name('reservation_process_data');
Route::post('/reservation_process_final_data', 'HomeController@reservation_process_final_data')->name('reservation_process_final_data');
Route::post('/about_edit_process', 'HomeController@about_edit_process')->name('about_edit_process');
Route::post('/about_edit_image', 'HomeController@about_edit_image')->name('about_edit_image');
Route::get('/carousel_active/{id}/{status}', 'HomeController@carousel_active')->name('carousel_active');
Route::post('/cancel_reservation/', 'HomeController@cancel_reservation')->name('cancel_reservation');
Route::get('/accomodation_status/{id}/{status}', 'HomeController@accomodation_status')->name('accomodation_status');
Route::get('/monthly_earning_report/', 'HomeController@monthly_earning_report')->name('monthly_earning_report');
Route::get('/yearly_earning_report/', 'HomeController@yearly_earning_report')->name('yearly_earning_report');

Route::get('/paid_downpayment/', 'HomeController@paid_downpayment')->name('paid_downpayment');
Route::get('/partial_payment/', 'HomeController@partial_payment')->name('partial_payment');
Route::get('/full_paid/', 'HomeController@full_paid')->name('full_paid');
Route::get('/cancelled/', 'HomeController@cancelled')->name('cancelled');

Route::get('/paid_downpayment_proecss/{id}/{email}', 'HomeController@paid_downpayment_proecss')->name('paid_downpayment_proecss');
Route::post('/reservation_payment_process/', 'HomeController@reservation_payment_process')->name('reservation_payment_process');




Route::post('/carousel_process', 'HomeController@carousel_process')->name('carousel_process');

Route::get('/book_now', 'WelcomeController@book_now')->name('book_now');
Route::post('/contact_us_process', 'WelcomeController@contact_us_process')->name('contact_us_process');
Route::post('/reservation_process', 'WelcomeController@reservation_process')->name('reservation_process');





// Route::get('/about', function () {
//     return view('about');
// })->name('about');
