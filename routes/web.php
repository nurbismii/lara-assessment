<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'check.access'], function () {
  Route::resource('assessment-aspect', '\App\Http\Controllers\AssessmentController');
  Route::resource('perform-achievement', '\App\Http\Controllers\PerformAchievementController');
  Route::resource('employee', '\App\Http\Controllers\EmployeeController');
  Route::post('employee-import', [App\Http\Controllers\EmployeeController::class, 'importStore'])->name('store.excel.employee');
  Route::post('employee-import-update', [App\Http\Controllers\EmployeeController::class, 'importUpdate'])->name('update.excel.employee');
  Route::resource('group', '\App\Http\Controllers\GroupController');
  Route::resource('evaluator', '\App\Http\Controllers\EvaluatorController');
  Route::resource('group-member', '\App\Http\Controllers\GroupMembersController');
  Route::resource('user', '\App\Http\Controllers\UserController');
  Route::post('user/disable/{id}', [App\Http\Controllers\UserController::class, 'disableUser'])->name('user.disable');
  Route::resource('report', '\App\Http\Controllers\ReportController');
  Route::get('report/download/excel/{year}/{month}', [App\Http\Controllers\ReportController::class, 'downloadReportExcel'])->name('download.excel');
  Route::get('report/download/pdf/{year}/{month}', [App\Http\Controllers\ReportController::class, 'downloadReportPdf'])->name('download.pdf');

  Route::group(['prefix' => 'api'], function () {
    Route::get('/employees', [App\Http\Controllers\Controller::class, 'fetchEmployee'])->name('fetch.employees');
    Route::get('/users', [App\Http\Controllers\Controller::class, 'fecthUser'])->name('fetch.users');
    Route::get('/evaluators', [App\Http\Controllers\Controller::class, 'fetchEvaluator'])->name('fetch.evaluators');
  });
});

Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');

Route::resource('evaluation', 'App\Http\Controllers\EvaluationController');
Route::get('evaluation/detail/{id}', [App\Http\Controllers\EvaluationController::class, 'detail'])->name('evaluation.detail');
Route::post('evaluation/destroy/{id}', [App\Http\Controllers\EvaluationController::class, 'destroyEvaluation'])->name('evaluation.evalDestroy');
