<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ApplyCouponController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\MarketersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\OutlooksController;
use App\Http\Controllers\PendingShotsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\WeatherShotsController;
use App\Models\Outlook;
use App\Models\Subscriptions;
use App\Models\Users;
use App\Models\WeatherShots;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'register']);
    Route::post('social/{service}', [AuthController::class, 'social']);
});

Route::post('admin/login', [AdminAuthController::class, 'login']);

Route::get('test', function () {
});

Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth'], function () {

    Route::post('users', [AuthController::class, 'getAll']);
    Route::post('delete-user', [AuthController::class, 'deleteUser']);
    Route::post('block-user', [AuthController::class, 'banUser']);
    Route::post('unblock-user', [AuthController::class, 'unBanUser']);

    Route::post('add-outlook', [OutlooksController::class, 'add']);
    Route::post('edit-outlook', [OutlooksController::class, 'edit']);
    Route::post('delete-outlook', [OutlooksController::class, 'delete']);
    Route::post('add-reply', [OutlooksController::class, 'reply']);
    Route::post('add-weathershot', [WeatherShotsController::class, 'add']);
    Route::post('delete-weathershot', [WeatherShotsController::class, 'delete']);
    Route::post('edit-weathershot', [WeatherShotsController::class, 'edit']);

    Route::post('delete-pending-weathershot', [PendingShotsController::class, 'delete']);
    Route::post('accept-pending-shot', [PendingShotsController::class, 'accept']);
    Route::post('reject-pending-shot', [PendingShotsController::class, 'reject']);

    Route::post('notifications', [NotificationsController::class, 'add']);
    Route::post('delete-notification', [NotificationsController::class, 'delete']);

    Route::post('add-coupon', [CouponsController::class, 'add']);
    Route::post('delete-coupon', [CouponsController::class, 'delete']);
    Route::post('edit-coupon', [CouponsController::class, 'edit']);
    Route::post('disable-coupon', [CouponsController::class, 'disable']);
    Route::post('enable-coupon', [CouponsController::class, 'enable']);

    Route::post('add-countries', [CountriesController::class, 'add']);
    Route::post('delete-countries', [CountriesController::class, 'delete']);

    Route::post('marketers', [MarketersController::class, 'get']);
    Route::post('marketer/{id}', [MarketersController::class, 'getByID']);
    Route::post('add-marketer', [MarketersController::class, 'add']);
    Route::post('edit-marketer', [MarketersController::class, 'edit']);
    Route::post('delete-marketer', [MarketersController::class, 'delete']);
    Route::post('disable-marketer', [MarketersController::class, 'disable']);
    Route::post('enable-marketer', [MarketersController::class, 'enable']);
    Route::post('block-marketer', [MarketersController::class, 'block']);
    Route::post('unblock-marketer', [MarketersController::class, 'unblock']);
    Route::post('withdraw-marketer', [MarketersController::class, 'withdraw_methods']);

    Route::post('tickets', [SupportTicketsController::class, 'get']);
    Route::post('close-ticket', [SupportTicketsController::class, 'close']);

    Route::post('add-ad', [AdsController::class, 'add']);
    Route::post('delete-ad', [AdsController::class, 'delete']);

    Route::post('subscriptions', [SubscriptionsController::class, 'get']);

    Route::post('admins', [AdminAuthController::class, 'admins']);
    Route::post('add-admin', [AdminAuthController::class, 'addAdmin']);
    Route::post('edit-admin', [AdminAuthController::class, 'editAdmin']);
    Route::post('get-admin', [AdminAuthController::class, 'getAdmin']);
    Route::post('block-admin', [AdminAuthController::class, 'block']);
    Route::post('unblock-admin', [AdminAuthController::class, 'unblock']);
    Route::post('delete-admin', [AdminAuthController::class, 'delete']);

    Route::post('update-profile', [AdminAuthController::class, 'updateProfile']);
    Route::post('update-password', [AdminAuthController::class, 'updatePassword']);

    Route::post('system-settings/satellite', [SystemSettingsController::class, 'satellite']);
    Route::post('system-settings/affiliate', [SystemSettingsController::class, 'affiliate']);

    Route::post('delete-unused', [OutlooksController::class, 'delete_unused']);
});

Route::get('comments', [OutlooksController::class, 'fetchComments']);
Route::post('send-comment', [OutlooksController::class, 'sendComment']);
Route::post('submit-like', [OutlooksController::class, 'like']);
Route::get('outlooks', [OutlooksController::class, 'get']);
Route::get('outlooks/{country}', [OutlooksController::class, 'getByCountry']);
Route::get('outlook/{id}', [OutlooksController::class, 'fetch']);

Route::get('weatherShots', [WeatherShotsController::class, 'get']);
Route::get('weather-shot/{id}', [WeatherShotsController::class, 'getByID']);
Route::get('pending-shots', [PendingShotsController::class, 'get']);
Route::post('send-pending-shot', [PendingShotsController::class, 'send'])->middleware('userToken');

Route::get('sattelite-link', [SystemSettingsController::class, 'getSatellite']);

Route::get('countries', [CountriesController::class, 'get']);

Route::post('notifications', [NotificationsController::class, 'get']);
Route::get('all-notifications', [NotificationsController::class, 'getAll']);

Route::post('send-ticket', [SupportTicketsController::class, 'add']);

Route::get('coupons', [CouponsController::class, 'get']);
Route::get('coupon/{id}', [CouponsController::class, 'getByID']);

Route::get('ads', [AdsController::class, 'get']);
Route::post('increase-views', [AdsController::class, 'views']);
Route::post('increase-clicks', [AdsController::class, 'clicks']);

Route::post('update-profile', [ProfileController::class, 'update'])->middleware('userToken');
Route::post('shared-posts', [ProfileController::class, 'shared_posts'])->middleware('userToken');
Route::post('send-reset-password', [ProfileController::class, 'send_reset_password']);
Route::post('check-reset-code', [ProfileController::class, 'check_reset_password_code']);
Route::post('reset-password', [ProfileController::class, 'reset_password']);

Route::post('apply-coupon', [ApplyCouponController::class, 'apply']);

Route::get('usersCount', function () {
    return Users::count();
});
Route::get('subsCount', function () {
    return Subscriptions::count();
});
Route::get('postsCount', function () {
    return Outlook::count();
});
Route::get('weatherShotsCount', function () {
    return WeatherShots::count();
});
Route::get('most-likes-posts', function () {
    return Outlook::orderBy('likes', 'DESC')->get();
});
