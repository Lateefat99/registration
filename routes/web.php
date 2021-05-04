<?php

use App\Http\Controllers\CreditDetail;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group(['middleware' => 'auth'], function() {
    Route::resource('tasks', TaskController::class);
    Route::resource('users', UserController::class);
    Route::resource('student', RegisterController::class);
    Route::resource('plan', PlanTypeController::class);
    Route::resource('studentType', StudentTypeController::class);
    Route::resource('studentPayment', PaymentController::class);
    Route::resource('report', ReportController::class);
    Route::resource('detail', CreditDetail::class);
    Route::resource('studentClass', StudentClassController::class);
    Route::get('report.paid', [ReportController::class, 'paid'])->name('report.paid');
    Route::get('studentByProgram', [ReportController::class, 'studentByProgram'])->name('studentByProgram');
    Route::get('studentPayment.details', [PaymentController::class, 'details'])->name('studentPayment.details');
    Route::get('findStudent', [RegisterController::class, 'findStudent'])->name('findStudent');
    Route::get('editStudent', [RegisterController::class, 'editStudent'])->name('editStudent');
    Route::get('editPro/{id}', [StudentTypeController::class, 'editPro'])->name('editPro');
    Route::post('addProgram', [StudentTypeController::class, 'addProgram'])->name('addProgram');
    Route::post('updateProgram/{id}', [StudentTypeController::class, 'updateProgram'])->name('updateProgram');
});
