<?php

use App\Http\Controllers\AttendanceMonitoringController;
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
use App\Http\Controllers\NilaiKedisiplinanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardFaceRecognizeController;
use App\Http\Controllers\DisciplineReportController;
use App\Http\Controllers\SpecialWorkingHoursController;
use App\Http\Controllers\AttendanceTypeController;
use App\Http\Controllers\DashboardGraficController;

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
    // Route::get('/dashboard-monitoring', [DashboardMonitoringController::class, 'index'])->name('dashboard.monitoring');
    Route::get('/dashboard-face-recognize', [DashboardFaceRecognizeController::class, 'index'])->name('dashboard.face-recognize');
    Route::get('/api/chart-data', [DashboardFaceRecognizeController::class, 'chartData'])->name('chart.data');
    Route::get('/dashbordmonitoring', [NilaiKedisiplinanController::class, 'index'])->name('nilai-kedisiplinan.index');
    Route::get('/nilai-kedisiplinan', [NilaiKedisiplinanController::class, 'index'])->name('nilai-kedisiplinan.index');
    Route::get('/recorded-videos', [RecordedVideoController::class, 'index'])->name('recorded-videos');
    Route::get('/recorded-videos/{id}/playback', [PlaybackController::class, 'playback'])->name('recorded-videos.playback');
    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'getDataPegawai'])->name('employee');
        Route::get('/{id}/edit', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
        Route::get('/{id}', [EmployeeController::class, 'showEmployee'])->name('employe.show');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });
    Route::get('/live-monitoring', [StreamingController::class, 'startStreaming'])->name('live-monitoring');
    Route::get('/discipline-reports', [KeyPerformanceKpiReportController::class, 'index'])->name('discipline-reports');
    Route::get('/discipline-reports-monthly', [KeyPerformanceKpiReportController::class, 'disciplineReports'])->name('discipline-reports-monthly');
    Route::get('/start-streaming', [StreamingController::class, 'startStreaming'])->name('start.streaming');
    Route::get('/attendance', [StreamingController::class, 'getAttendance'])->name('get.attendance');
    Route::post('/presensi/filter', [EmployeeController::class, 'getDataPegawai'])->name('presensi.filter');
    Route::get('/employee-presence', [EmployeePresenceController::class, 'index'])->name('employee-presence');
    Route::get('/attendance-monitoring', [AttendanceMonitoringController::class, 'index'])->name('attendance-monitoring');
    Route::resource('pengaturan', \App\Http\Controllers\PengaturanController::class);
    Route::prefix('pengaturan')->middleware('auth')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::get('/create', [PengaturanController::class, 'create'])->name('pengaturan.create');
        Route::post('/', [PengaturanController::class, 'store'])->name('pengaturan.store');
        Route::get('/{id}/edit', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
        Route::put('/{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
        Route::delete('/{id}', [PengaturanController::class, 'destroy'])->name('pengaturan.destroy');
    });
    // Pengaturan
    Route::prefix('settings')->group(function () {
        Route::get('attendance-types', [SettingsController::class, 'attendanceTypes'])->name('settings.attendance-types');
        // Route::get('special-working-hours', [SettingsController::class, 'specialWorkingHours'])->name('settings.special-working-hours');
        Route::get('leave-types', [SettingsController::class, 'leaveTypes'])->name('settings.leave-types');
        Route::get('holidays', [SettingsController::class, 'holidays'])->name('settings.holidays');
        Route::get('criteria', [SettingsController::class, 'criteria'])->name('settings.criteria');
        Route::get('upload-video', [SettingsController::class, 'uploadVideo'])->name('settings.upload_video'); // Untuk menampilkan form upload
        Route::post('upload-video', [SettingsController::class, 'storeVideo'])->name('settings.store_video');
        Route::get('discipline-reports', [SettingsController::class, 'disciplineReports'])->name('settings.descipline-reports');
    });
    // Jam Kerja Khusus
    Route::prefix('settings')->group(function () {
        Route::get('special-working-hours', [SpecialWorkingHoursController::class, 'index'])->name('settings.special-working-hours.index');
        Route::get('special-working-hours/create', [SpecialWorkingHoursController::class, 'create'])->name('settings.special-working-hours.create');
        Route::post('special-working-hours', [SpecialWorkingHoursController::class, 'store'])->name('settings.special-working-hours.store');
        Route::get('special-working-hours/{id}/edit', [SpecialWorkingHoursController::class, 'edit'])->name('settings.special-working-hours.edit');
        Route::put('special-working-hours/{id}', [SpecialWorkingHoursController::class, 'update'])->name('settings.special-working-hours.update');
        Route::delete('special-working-hours/{id}', [SpecialWorkingHoursController::class, 'destroy'])->name('settings.special-working-hours.destroy');
    });
    // Tipe Jam Kerja
    Route::prefix('settings')->group(function () {
        Route::get('attendance-types', [AttendanceTypeController::class, 'index'])->name('settings.attendance-types.index');
        Route::get('attendance-types/create', [AttendanceTypeController::class, 'create'])->name('settings.attendance-types.create');
        Route::post('attendance-types', [AttendanceTypeController::class, 'store'])->name('settings.attendance-types.store');
        Route::get('attendance-types/{id}/edit', [AttendanceTypeController::class, 'edit'])->name('settings.attendance-types.edit');
        Route::put('attendance-types/{id}', [AttendanceTypeController::class, 'update'])->name('settings.attendance-types.update');
        Route::delete('attendance-types/{id}', [AttendanceTypeController::class, 'destroy'])->name('settings.attendance-types.destroy');
    });
    Route::get('/help', [HelpController::class, 'index'])->name('help');
    Route::get('/presensi', [EmployeePresenceController::class, 'index'])->name('employee-presence.index');
    Route::put('/presensi/{id}', [EmployeePresenceController::class, 'update'])->name('employee-presence.update');
    Route::get('/presensi', [EmployeePresenceController::class, 'index'])->name('employee-presence.index');
    Route::get('/laporan-kedisiplinan/print', [DisciplineReportController::class, 'printDisciplineReport'])->name('print-discipline-report');

    Route::get('/dashboard-grafic', [DashboardGraficController::class, 'index'])->name('dashboard-grafic'); 

});

