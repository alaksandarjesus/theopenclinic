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

Route::get('/', 'App\Http\Controllers\Guest\LoginController@index');

Route::post('guest/login', 'App\Http\Controllers\Guest\LoginController@attempt');

Route::get('profile', 'App\Http\Controllers\ProfileController@index')->middleware('authorize');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('authorize');


Route::get('/logout', 'App\Http\Controllers\Guest\LoginController@logout')->middleware('authorize');

Route::group(['prefix' => 'roles', 'middleware' => 'authorize:superadministrator'], function () {
    Route::get('', 'App\Http\Controllers\RolesController@index');
    Route::post('', 'App\Http\Controllers\RolesController@store');
    Route::put('{uuid}', 'App\Http\Controllers\RolesController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\RolesController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'users', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Users\UsersController@index');
    Route::get('create', 'App\Http\Controllers\Users\UsersController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Users\UsersController@edit');
    Route::post('', 'App\Http\Controllers\Users\UsersController@store');
    Route::delete('{uuid}', 'App\Http\Controllers\Users\UsersController@delete')->middleware('authorize:superadministrator');
});

Route::group(['prefix' => 'pharmacy/categories', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\CategoriesController@index');
    Route::post('', 'App\Http\Controllers\Pharmacy\CategoriesController@store');
    Route::put('{uuid}', 'App\Http\Controllers\Pharmacy\CategoriesController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\CategoriesController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'pharmacy/suppliers', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\SuppliersController@index');
    Route::get('create', 'App\Http\Controllers\Pharmacy\SuppliersController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\SuppliersController@edit');
    Route::post('', 'App\Http\Controllers\Pharmacy\SuppliersController@store');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\SuppliersController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'pharmacy/compositions', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\CompositionsController@index');
    Route::get('{uuid}', 'App\Http\Controllers\Pharmacy\CompositionsController@get');
    Route::post('', 'App\Http\Controllers\Pharmacy\CompositionsController@store');
    Route::put('{uuid}', 'App\Http\Controllers\Pharmacy\CompositionsController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\CompositionsController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'pharmacy/drugs', 'middleware' => 'authorize:administrator|pharmacist'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\DrugsController@index');

});


Route::group(['prefix' => 'pharmacy/drugs', 'middleware' => 'authorize:administrator'], function () {
    Route::get('create', 'App\Http\Controllers\Pharmacy\DrugsController@create');
    Route::get('{uuid}/history', 'App\Http\Controllers\Pharmacy\DrugHistoryController@index');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\DrugsController@edit');
    Route::post('', 'App\Http\Controllers\Pharmacy\DrugsController@store');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\DrugsController@delete')->middleware("authorize:superadministrator");
    Route::get('{uuid}/refresh', 'App\Http\Controllers\Pharmacy\DrugsController@refresh');
});

Route::group(['prefix' => 'settings', 'middleware' => 'authorize:superadministrator'], function () {
    Route::get('', 'App\Http\Controllers\SettingsController@index');
    Route::post('clinic-info', 'App\Http\Controllers\SettingsController@clinic_info');
});

Route::group(['prefix' => 'pharmacy/purchases', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@index');
    Route::get('typeahead', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@typeahead');
    Route::get('create', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@edit');
    Route::get('{uuid}/print', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@print');
    Route::post('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@save');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesController@delete')->middleware("authorize:superadministrator");

});
Route::group(['prefix' => 'pharmacy/purchases/{purchase_order_uuid}/inventory', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@get');
    Route::get('create', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@create');
    Route::get('{inventory_uuid}/edit', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@edit');
    Route::post('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@save');
    Route::put('{inventory_uuid}', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@update');
    Route::delete('{inventory_uuid}', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesInventoryController@delete')->middleware("authorize:superadministrator");

});

Route::group(['prefix' => 'pharmacy/purchases/{purchase_order_uuid}/returns', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@index');
    Route::get('create', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@edit');
    Route::post('', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@save');
    Route::put('{uuid}', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\Purchases\PurchasesReturnController@delete')->middleware("authorize:superadministrator");

});

Route::group(['prefix' => 'pharmacy/invoices', 'middleware' => 'authorize:administrator|pharmacist'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@index');
    Route::get('typeahead', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@typeahead');
    Route::get('create', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@edit');
    Route::get('{uuid}/print', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@print');
    Route::post('', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@save');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesController@delete')->middleware("authorize:superadministrator");

});

Route::group(['prefix' => 'pharmacy/invoices/{invoice_uuid}/returns', 'middleware' => 'authorize:administrator|pharmacist'], function () {
    Route::get('', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@index');
    Route::get('create', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@create');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@edit');
    Route::post('', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@save');
    Route::put('{uuid}', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Pharmacy\Invoices\InvoicesReturnController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'users', 'middleware' => 'authorize:administrator|doctor|frontdesk'], function () {
    Route::post('search', 'App\Http\Controllers\Users\UsersController@search');
    Route::post('{uuid}/user-custom-values', 'App\Http\Controllers\Users\UserCustomValuesController@save');
});

Route::group(['prefix' => 'appointments/{uuid}/pre-consultation', 'middleware' => 'authorize'], function () {
    Route::get('', 'App\Http\Controllers\PreConsultation\PreConsultationController@index');
    Route::post('', 'App\Http\Controllers\PreConsultation\PreConsultationController@store');

});

Route::group(['prefix' => 'appointments/{uuid}/consultation', 'middleware' => 'authorize'], function () {
    Route::get('', 'App\Http\Controllers\Consultation\ConsultationController@get');
    Route::post('', 'App\Http\Controllers\Consultation\ConsultationController@store');

});

Route::group(['prefix' => 'appointments/{uuid}/payments', 'middleware' => 'authorize'], function () {
    Route::get('', 'App\Http\Controllers\Payments\AppointmentPaymentsController@get');
    Route::post('', 'App\Http\Controllers\Payments\AppointmentPaymentsController@store');
});

Route::group(['prefix' => 'appointments', 'middleware' => 'authorize'], function () {

    Route::group(['middleware' => 'authorize:administrator|doctor|frontdesk'], function () {
        Route::get('', 'App\Http\Controllers\Appointments\IndexController@index');
        Route::get('{uuid}/print', 'App\Http\Controllers\Appointments\PrintController@index');
    });

    Route::get('create', 'App\Http\Controllers\Appointments\CreateController@index');
    Route::post('', 'App\Http\Controllers\Appointments\CreateController@save');

    Route::group(['middleware' => 'authorize:administrator|frontdesk'], function () {
        Route::get('edit/{uuid}', 'App\Http\Controllers\Appointments\EditController@index');
        Route::put('', 'App\Http\Controllers\Appointments\EditController@save');
    });

    Route::post('doctor-availability', 'App\Http\Controllers\Appointments\IndexController@doctor_availability');
    Route::delete('{uuid}', 'App\Http\Controllers\Appointments\IndexController@delete')->middleware('authorize:administrator');

});

Route::group(['prefix' => 'preconsultation-fields', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\PreConsultation\PreConsultationFieldsController@index');
    Route::post('', 'App\Http\Controllers\PreConsultation\PreConsultationFieldsController@store');
    Route::put('{uuid}', 'App\Http\Controllers\PreConsultation\PreConsultationFieldsController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\PreConsultation\PreConsultationFieldsController@delete')->middleware("authorize:superadministrator");

});

Route::group(['prefix' => 'user-custom-fields', 'middleware' => 'authorize:superadministrator'], function () {
    Route::get('', 'App\Http\Controllers\Users\UserCustomFieldsController@index');
    Route::post('', 'App\Http\Controllers\Users\UserCustomFieldsController@store');
    Route::put('{uuid}', 'App\Http\Controllers\Users\UserCustomFieldsController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Users\UserCustomFieldsController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'payments', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Payments\PaymentsController@index');
    Route::get('{uuid}/edit', 'App\Http\Controllers\Payments\PaymentsController@edit');
    Route::put('{uuid}', 'App\Http\Controllers\Payments\PaymentsController@update');
    Route::delete('{uuid}', 'App\Http\Controllers\Payments\PaymentsController@delete')->middleware('authorize:superadministrator');
});

Route::group(['prefix' => 'expenditures', 'middleware' => 'authorize:administrator'], function () {
    Route::get('', 'App\Http\Controllers\Expenditures\ExpendituresController@index');
    Route::post('', 'App\Http\Controllers\Expenditures\ExpendituresController@store');
    Route::delete('{uuid}', 'App\Http\Controllers\Expenditures\ExpendituresController@delete')->middleware("authorize:superadministrator");
});

Route::group(['prefix' => 'notifications'], function(){
    Route::get('', 'App\Http\Controllers\Notifications\NotificationsController@index')->middleware('authorize');
    Route::get('create', 'App\Http\Controllers\Notifications\NotificationsController@create')->middleware('authorize');
    Route::get('{uuid}/reply', 'App\Http\Controllers\Notifications\NotificationsController@reply')->middleware('authorize');
    Route::post('', 'App\Http\Controllers\Notifications\NotificationsController@save')->middleware('authorize');
    Route::delete('{uuid}', 'App\Http\Controllers\Notifications\NotificationsController@delete')->middleware('authorize');
});

Route::group(['prefix' => 'messages'], function(){
    Route::get('', 'App\Http\Controllers\Messages\MessagesController@index')->middleware('authorize');
    Route::get('create', 'App\Http\Controllers\Messages\MessagesController@create')->middleware('authorize');
    Route::get('{uuid}/reply', 'App\Http\Controllers\Messages\MessagesController@reply')->middleware('authorize');
    Route::post('', 'App\Http\Controllers\Messages\MessagesController@save')->middleware('authorize');
    Route::delete('{uuid}', 'App\Http\Controllers\Messages\MessagesController@delete')->middleware('authorize');
});



Route::get('migrate', function () {

    \Artisan::call('migrate:refresh --seed');

    dd("Migration Successful");

});