<?php

use App\Models\User;
use App\Models\Attendance;
use App\Filament\Pages\StudentPage;
use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Auth\EditProfile;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\QrGeneratorController;

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

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/epro', EditProfile::class);

// Route::get('/santulitam-register', [StudentPage::class, 'form']);

Route::get('/qr/student/{value}', [QrGeneratorController::class, 'student']);

Route::resource('scan-attendances', AttendanceController::class);