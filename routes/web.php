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


Route::get('/','loginController@showlogin')->name('mainpage');

Route::post('/login','loginController@checklogin');

Route::get('userRegistration', function () {
    return view('pages.userRegisterForm');
});

Route::post('/checkAvailable','loginController@userEmailCheck');

Route::post('/userRegStore','loginController@userRegStore');

//  Admin Routes
Route::post('checkAvailableBook','adminController@Bookidavailable');

Route::post('BookStore','adminController@Bookadd');

Route::post('BookChange','adminController@Bookupdate');

Route::get('BookDelete','adminController@Bookremove')->name('admin.bookremove');

Route::get('SingleBook','adminController@Book')->name('admin.viewbook');

Route::get('SingleBookSubs','adminController@subscriberSB')->name('admin.getsublist');

Route::post('Bookimport', 'adminController@importBooks')->name('import');

Route::get('BarChart', 'adminController@subChart')->name('admin.SubscribeChart');

//User Routes
Route::get('User','userController@showuser');

Route::get('SubscribeResponse/{userid}/{Bookid}',['uses'=>'userController@BookSub','as'=> 'subscribeReq']);

Route::get('SubscribeResponseRemove/{userid}/{Bookid}',['uses'=>'userController@BookDeleteSub','as'=> 'subscribeReqDelete']);

Route::group(['middleware'=>['CustomAuth']],function(){
  Route::get('Admin','adminController@showpage');

});
//SignOut
Route::get('SignOut','loginController@logout')->name('full.logout');
