<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Streaming;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyPerformanceKpiReportController;
use App\Models\KeyPerformanceKpiReport;
use App\Http\Controllers\EmployeePresenceController;
use App\Http\Controllers\DashboardMonitoringController;
use App\Http\Controllers\RecordedVideoController;
use App\Http\Controllers\StreamingController;
use App\Http\Controllers\PlaybackController;
use App\Http\Controllers\HelpController;


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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'components', 'as' => 'components.'], function() {
        Route::get('/alert', function () {
            return view('admin.component.alert');
        })->name('alert');
        Route::get('/accordion', function () {
            return view('admin.component.accordion');
        })->name('accordion');
    });

    Route::get('/monitoring', function () {
        return view('admin.livemonitoring.monitoring');
    })->name('monitoring');
    Route::get('/dashbordmonitoring', [DashboardMonitoringController::class, 'index'])->name('dasbordmonitoring');;
    Route::get('/recorded-videos', [RecordedVideoController::class, 'index'])->name('recorded-videos');
    Route::get('/recorded-videos/{id}/playback', [PlaybackController::class, 'playback'])->name('recorded-videos.playback');
    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'getDataPegawai'])->name('employee');
        Route::get('/{id}/edit', [EmployeeController::class, 'editEmployee'])->name('users.edit');
        Route::get('/{id}', [EmployeeController::class, 'showEmployee'])->name('users.show');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('users.destroy');
    });
    Route::get('/live-monitoring', [StreamingController::class, 'startStreaming'])->name('live-monitoring');
    Route::get('/discipline-reports', [KeyPerformanceKpiReportController::class, 'index'])->name('discipline-reports');
    Route::get('/start-streaming', [StreamingController::class, 'startStreaming'])->name('start.streaming');
    Route::get('/attendance', [StreamingController::class, 'getAttendance'])->name('get.attendance');
    Route::get('/employee', [EmployeeController::class, 'getDataPegawai'])->name('employee');
    Route::post('/presensi/filter', [EmployeeController::class, 'getDataPegawai'])->name('presensi.filter');
    Route::get('/employee-presence', [EmployeePresenceController::class, 'index'])->name('employee-presence');
    Route::get('/attendance-monitoring', [AttendanceMonitoringController::class, 'index'])->name('attendance-monitoring');
    Route::prefix('settings')->group(function () {
        Route::get('attendance-types', [SettingsController::class, 'attendanceTypes'])->name('settings.attendance-types');
        Route::get('special-working-hours', [SettingsController::class, 'specialWorkingHours'])->name('settings.special-working-hours');
        Route::get('leave-types', [SettingsController::class, 'leaveTypes'])->name('settings.leave-types');
        Route::get('holidays', [SettingsController::class, 'holidays'])->name('settings.holidays');
    });
    Route::get('/help', [HelpController::class, 'index'])->name('help');


    Route::get('/presensi', function () {
        return view('presensi.presensi', [
            'selectOptions' => $selectOptions,
            'dataUnit' => $dataUnit,
            'dataTypePresence' => $dataTypePresence,
            'pageNumber' => $pageNumber
        ]);
    });
});

