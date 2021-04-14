<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/', [App\Http\Controllers\FirstPageController::class, 'index']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::post('profile/update_profile', [App\Http\Controllers\ProfileController::class, 'update_profile']);
Route::post('profile/change_password_profile', [App\Http\Controllers\ProfileController::class, 'change_password_profile']);

Route::get('user/get/get_datatable', [App\Http\Controllers\UserController::class, 'get_datatable']);
Route::get('user/get/get_by_id/{id}', [App\Http\Controllers\UserController::class, 'get_by_id']);
Route::post('user/update/change_password/{id}', [App\Http\Controllers\UserController::class, 'change_password']);
Route::resource('user', App\Http\Controllers\UserController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'user');

// เมนูเดี่ยว
Route::get('note/get/get_datatable', [App\Http\Controllers\NoteController::class, 'get_datatable']);
Route::get('note/get/get_by_id/{id}', [App\Http\Controllers\NoteController::class, 'get_by_id']);
Route::resource('note', App\Http\Controllers\NoteController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'note');

Route::get('/textbox', function () {
    return view('text_box');
})->name('textbox');


// ตารางอ้างอิง
Route::get('package/get/get_datatable', [App\Http\Controllers\PackageController::class, 'get_datatable']);
Route::get('package/get/get_by_id/{id}', [App\Http\Controllers\PackageController::class, 'get_by_id']);
Route::resource('package', App\Http\Controllers\PackageController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'package');

Route::get('freelance/get/get_datatable', [App\Http\Controllers\FreelanceController::class, 'get_datatable']);
Route::get('freelance/get/get_by_id/{id}', [App\Http\Controllers\FreelanceController::class, 'get_by_id']);
Route::resource('freelance', App\Http\Controllers\FreelanceController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'freelance');

Route::get('setting_system', [App\Http\Controllers\SettingSystemController::class, 'pade_setting'])->name('setting_system');
Route::post('setting_system/post/update_setting/{id}', [App\Http\Controllers\SettingSystemController::class, 'update_setting']);

// ฟอร์มกรอกข้อมูล
Route::get('manage_task/get/get_datatable', [App\Http\Controllers\ManageTaskController::class, 'get_datatable']);
Route::get('manage_task/get/get_datatable_freelance', [App\Http\Controllers\ManageTaskController::class, 'get_datatable_freelance']);
Route::get('manage_task/get/get_datatable_package', [App\Http\Controllers\ManageTaskController::class, 'get_datatable_package']);
Route::get('manage_task/get/get_by_id/{id}', [App\Http\Controllers\ManageTaskController::class, 'get_by_id']);
Route::resource('manage_task', App\Http\Controllers\ManageTaskController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'manage_task');

Route::get('customer_google_adses/get/get_datatable', [App\Http\Controllers\CustomerGoogleAdsController::class, 'get_datatable']);
Route::get('customer_google_adses/get/get_datatable_no_service', [App\Http\Controllers\CustomerGoogleAdsController::class, 'get_datatable_no_service']);
Route::get('customer_google_adses/get/get_by_id/{id}', [App\Http\Controllers\CustomerGoogleAdsController::class, 'get_by_id']);
Route::resource('customer_google_adses', App\Http\Controllers\CustomerGoogleAdsController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'customer_google_adses');

Route::get('receipt/get/get_datatable', [App\Http\Controllers\ReceiptController::class, 'get_datatable']);
Route::get('receipt/get/get_by_id/{id}', [App\Http\Controllers\ReceiptController::class, 'get_by_id']);
Route::post('receipt/update/update_data/{id}', [App\Http\Controllers\ReceiptController::class, 'update_data']);
Route::post('receipt/update/update_upload/{id}', [App\Http\Controllers\ReceiptController::class, 'update_upload']);
Route::resource('receipt', App\Http\Controllers\ReceiptController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'receipt');

Route::get('receipt_company/get/get_datatable', [App\Http\Controllers\ReceiptCompanyController::class, 'get_datatable']);
Route::get('receipt_company/get/get_by_id/{id}', [App\Http\Controllers\ReceiptCompanyController::class, 'get_by_id']);
Route::post('receipt_company/update/update_data/{id}', [App\Http\Controllers\ReceiptCompanyController::class, 'update_data']);
Route::post('receipt_company/update/update_upload_file_doc_2/{id}', [App\Http\Controllers\ReceiptCompanyController::class, 'update_upload_file_doc_2']);
Route::post('receipt_company/update/update_upload_file_doc_3/{id}', [App\Http\Controllers\ReceiptCompanyController::class, 'update_upload_file_doc_3']);
Route::resource('receipt_company', App\Http\Controllers\ReceiptCompanyController::class)->only([
    'index', 'store', 'update', 'destroy'
])->name('index', 'receipt_company');

