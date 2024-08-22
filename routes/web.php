<?php

use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Filament\Pages\StudentPage;
use function Laravel\Prompts\search;
use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Auth\EditProfile;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SearchQRController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\QrGeneratorController;

use App\Http\Controllers\StudentCardController;
use App\Http\Controllers\CofasilitatorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     return redirect('/central/');
// });

Route::get('/u', function () {
    $u = User::all();
    // $u = dd(fn() => auth()->user()->user_role_id === 1);
    // $u = auth()->user()->user_role_id;
    return $u;
});

Route::get('/api-students', function () {
    // Ambil semua data mahasiswa
    $students = Student::all();

    // Kembalikan data sebagai response JSON
    return response()->json([
        'success' => true,
        'data' => $students,
    ]);
});

Route::get('/phpinfo', function () {
    // $r = Str::title('APAPUN ITU');
    phpinfo();
    // return $r;
});

Route::get('/epro', EditProfile::class);

// Route::get('/santulitam-register', [StudentPage::class, 'form']);

Route::get('/qr/student/{value}/{format}', [QrGeneratorController::class, 'student']);
Route::get('/qr/student/{value}', [QrGeneratorController::class, 'save']);

Route::resource('scan-attendances', AttendanceController::class);

Route::resource('/pendataan-peserta-karisma', StudentController::class);

Route::resource('/pendataan-cofasilitator', CofasilitatorController::class);

Route::get('/download-qr', [SearchQRController::class, 'index'])->name('download-qr.index');
Route::post('/download-qr', [SearchQRController::class, 'download'])->name('download-qr.download');

Route::get('/student-card', [StudentCardController::class, 'index']);