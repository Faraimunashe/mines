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
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    //dashboard
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    //subscription
    Route::get('/admin/subscriptions', 'App\Http\Controllers\admin\SubscriptionController@index')->name('admin-subscriptions');
    Route::post('/admin/update/subscription', 'App\Http\Controllers\admin\SubscriptionController@update')->name('admin-update-subscription');

    //minerals
    Route::get('/admin/minerals', 'App\Http\Controllers\admin\MineralController@index')->name('admin-minerals');
    Route::post('/admin/update/minerals', 'App\Http\Controllers\admin\MineralController@update')->name('admin-update-minerals');

    //mines
    Route::get('/admin/mines', 'App\Http\Controllers\admin\MineController@index')->name('admin-mines');

    //clients
    Route::get('/admin/clients', 'App\Http\Controllers\admin\ClientController@index')->name('admin-clients');

    //clients
    Route::get('/admin/sales', 'App\Http\Controllers\admin\SaleController@index')->name('admin-sales');

    //sales
    Route::get('/admin/consultants', 'App\Http\Controllers\admin\ConsultantController@index')->name('admin-consultants');

    //consults
    Route::get('/admin/consults', 'App\Http\Controllers\admin\ConsultController@index')->name('admin-consults');
    Route::post('/admin/update/consults', 'App\Http\Controllers\admin\ConsultController@update')->name('admin-update-consults');

    //shares
    Route::get('/admin/shares', 'App\Http\Controllers\admin\ShareController@index')->name('admin-shares');
    Route::post('/admin/update/shares', 'App\Http\Controllers\admin\ShareController@update')->name('admin-update-shares');

});

Route::group(['middleware' => ['auth', 'role:consultant']], function () {
    //dashboard
    Route::get('/consultant/dashboard', 'App\Http\Controllers\consultant\DashboardController@index')->name('consultant-dashboard');

    //details
    Route::get('/input/consultant/details', 'App\Http\Controllers\consultant\DashboardController@details')->name('consultant-details');
    Route::post('/input/consultant/detail', 'App\Http\Controllers\consultant\DashboardController@add')->name('consultant-add');

    //minerals
    Route::get('/consultant/consults', 'App\Http\Controllers\consultant\ConsultController@index')->name('consultant-consults');
    Route::post('/consultant/input/consults', 'App\Http\Controllers\consultant\ConsultController@add')->name('consultant-add-consults');
    Route::get('/delete/consult/{id}', 'App\Http\Controllers\consultant\ConsultController@delete')->name('consultant-delete-consult');

});

Route::group(['middleware' => ['auth', 'role:mine']], function () {

    //dashboard
    Route::get('/mine/dashboard', 'App\Http\Controllers\mine\DashboardController@index')->name('mine-dashboard');

    //details
    Route::get('/input/mine/details', 'App\Http\Controllers\mine\DashboardController@details')->name('mine-details');
    Route::post('/input/mine/detail', 'App\Http\Controllers\mine\DashboardController@add')->name('mine-add');

    //minerals
    Route::get('/mine/minerals', 'App\Http\Controllers\mine\MineralController@index')->name('mine-minerals');
    Route::post('/mine/input/mineral', 'App\Http\Controllers\mine\MineralController@add')->name('mine-add-minerals');
    Route::get('/mine/delete/mineral/{id}', 'App\Http\Controllers\mine\MineralController@delete')->name('mine-delete-mineral');

    //minerals
    Route::get('/mine/bids', 'App\Http\Controllers\mine\MineralController@bids')->name('mine-bids');
    Route::get('/mine/bid/{id}', 'App\Http\Controllers\mine\MineralController@chose_bid')->name('mine-chose-bid');

    //sales
    Route::get('/mine/sales', 'App\Http\Controllers\mine\SaleController@index')->name('mine-sales');

});

Route::group(['middleware' => ['auth', 'role:client']], function () {
    //dashboard
    Route::get('/client/dashboard', 'App\Http\Controllers\client\DashboardController@index')->name('client-dashboard');

    //details
    Route::get('/input/client/details', 'App\Http\Controllers\client\DashboardController@details')->name('client-details');
    Route::post('/input/client/detail', 'App\Http\Controllers\client\DashboardController@add')->name('client-add');

    //details
    Route::get('/client/minerals', 'App\Http\Controllers\client\BidController@index')->name('client-minerals');
    Route::post('/client/bid', 'App\Http\Controllers\client\BidController@bid')->name('client-bid');

    //subscription
    Route::post('/client/subscribe', 'App\Http\Controllers\client\SubscriptionController@subscribe')->name('client-subscribe');

    //bidding
    Route::get('/client/bidding', 'App\Http\Controllers\client\BidController@index')->name('client-bidding');
    Route::post('/client/mineral/bidding', 'App\Http\Controllers\client\BidController@bid')->name('client-bid');

    //bidding details
    Route::get('/client/bid/{id}', 'App\Http\Controllers\client\BidDetailController@index')->name('client-bid-details');
    Route::post('/client/bid/payment', 'App\Http\Controllers\client\BidDetailController@payment')->name('client-bid-payment');

    //purchases
    Route::get('/client/purchases', 'App\Http\Controllers\client\PurchaseController@index')->name('client-purchases');

});

require __DIR__.'/auth.php';
