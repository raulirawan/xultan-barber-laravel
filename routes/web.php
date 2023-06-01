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

Route::get('/','HomeController@index')->name('home');

//ROUTE KIRIM PESAN
Route::post('/sendMessage','HomeController@sendMessage')->name('send-message');


Route::prefix('user')
        ->middleware(['auth'])
        ->group( function(){

            Route::get('/dashboard','DashboardController@index')->name('dashboard');
            Route::get('/booking','DashboardController@booking')->name('dashboard-booking');

            Route::get('/booking/data','DashboardController@indexBooking')->name('dashboard-booking-index');

            // Route::post('/booking/{date}','DashboardController@booking')->name('date-booking');
            Route::post('/booking/create','DashboardController@store')->name('dashboard-booking-store');
            Route::delete('/booking/data/{booking}','DashboardController@cancelBooking')->name('dashboard-booking-cancel');
            Route::get('/change/password','Auth\ChangePasswordController@index')->name('change-password');
            Route::post('/change/password/update','Auth\ChangePasswordController@changePassword')->name('change-password-update');
});

// Route Barber

// Route::prefix('barber')
//         ->middleware(['auth','barber'])
//         ->group(function() {
//             Route::get('/','Barber\DashboardController@index')->name('barber.dashboard');
//             Route::get('/booking','Barber\BookingController@index')->name('barber.booking');
//             Route::delete('/booking/{booking}','Barber\BookingController@cancelBooking')->name('barber.cancel');
//             Route::post('/barber/work','Barber\DashboardController@work')->name('barber.work');
//             Route::post('/barber/finish','Barber\DashboardController@finishWork')->name('barber.finish.work');
//         });


// Route Admin

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth','admin'])
        ->group(function() {
            Route::get('/','DashboardController@index')->name('admin-dashboard');

            Route::put('/accept/{id}','DashboardController@accept')->name('booking-accept');
            Route::put('/cancel/{id}','DashboardController@cancel')->name('booking-cancel');

            Route::get('/jadwal','BookingController@jadwal')->name('jadwal-booking');

            Route::resource('/user', 'UserController');
            Route::resource('/message', 'MessageController');
            Route::resource('/gallery', 'GalleryController');
            Route::resource('/booking', 'BookingController');
            Route::resource('/barber', 'BarberController');
        });

Auth::routes();

