<?php

use App\Http\Controllers\AdminPakarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PestisidaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
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



Route::get('/keuntungan', function () {
    return view('kalkulator/keuntungan');
});

route::post('/logout', [SigninController::class, 'logout1']);

route::post('/logout', [SigninController::class, 'logout2']);

route::get('/', [DashboardController::class, 'index'])->name('index');


route::group(['middleware' => ['auth:user,pakar,admin']], function () {
    Route::get('/pestisida', function () {
        return view('kalkulator/pestisida');
    });
    Route::get('/pupuk-urea', function () {
        return view('kalkulator/pupuk-urea');
    });
    Route::get('/pupuk-kotoran-ayam', function () {
        return view('kalkulator/kotoran-ayam');
    });
    Route::get('/pupuk-SP-36', function () {
        return view('kalkulator/SP-36');
    });
    // route profile 3 aktor
    route::get('/profile', [ProfileController::class, 'show1'])->name('profile');
    route::get('/profilepakar', [ProfileController::class, 'show2'])->name('profilepakar');
    route::get('/profileadmin', [ProfileController::class, 'show3'])->name('profileadmin');
    // route edit pakar dan update
    route::get('/edit-pakar', [ProfileController::class, 'index2']);
    route::patch('/update-pakar', [ProfileController::class, 'update2']);
    route::get('/edit-user', [ProfileController::class, 'index1']);
    route::patch('/update-user', [ProfileController::class, 'update1']);
    route::get('/edit-admin', [ProfileController::class, 'index3']);
    route::patch('/update-admin', [ProfileController::class, 'update3']);
    route::get('/cv-sertifikat', [ProfileController::class, 'index4']);
    route::post('/cv-sertifikat', [ProfileController::class, 'update4']);
    // route edit password
    route::get('/edit-password-user', [PasswordController::class, 'index1']);
    route::put('/update-password-user', [PasswordController::class, 'update1']);
    route::get('/edit-password-admin', [PasswordController::class, 'index2']);
    route::put('/update-password-admin', [PasswordController::class, 'update2']);
    route::get('/edit-password-pakar', [PasswordController::class, 'index3'])->name('edit-password-pakar');
    route::put('/update-password-pakar', [PasswordController::class, 'update3']);
    // database admin
    route::get('/database', [DatabaseController::class, 'show1']);
    route::get('/database-user', [DatabaseController::class, 'show1'])->name('database-user');
    route::get('/database-pakar', [DatabaseController::class, 'show2'])->name('database-pakar');
    route::get('/pengajuan-kursus', [DatabaseController::class, 'show3'])->name('pengajuan-kursus');
    route::post('/persetujuan-kursus', [DatabaseController::class, 'store'])->name('persetujuan-kursus');
    route::post('/persetujuan-pakar', [DatabaseController::class, 'store1'])->name('persetujuan-pakar');
    route::get('/invoice-course', [DatabaseController::class, 'show4'])->name('invoice-course');
    // route pengajuan kursus
    route::get('/pengajuan-main', [CourseController::class, 'index'])->name('pengajuan-index');
    route::get('/pengajuan', [CourseController::class, 'create'])->name('pengajuan');
    route::post('/pengajuan', [CourseController::class, 'store'])->name('pengajuan-post');
    route::get('/pengajuan-video', [CourseController::class, 'create1'])->name('pengajuan-video');
    route::delete('/pengajuan-delete/{course}', [CourseController::class, 'destroy'])->name('pengajuan-destroy');
    // route konten kursus
    route::get('/kursus', [CourseController::class, 'show1'])->name('course');
    route::get('/konten-kursus{course}', [CourseController::class, 'show2'])->name('konten-kursus');
    route::get('/kursus-saya', [CourseController::class, 'show3'])->name('kursus-saya');
    // pembayaran kursus
    route::post('/detail-pembayaran', [CourseController::class, 'checkout'])->name('detail-pembayaran');
    route::get('/invoice/{id}', [CourseController::class, 'invoice']);


});

route::group(['middleware' => ['guest:user,pakar,admin']], function () {
    Route::get('/mulai', function () {
        return view('main');
    })->name('mulai');
    Route::get('/daftar', function () {
        return view('signupmain');
    })->name('daftar');
    route::get('/signin', [SigninController::class, 'index1'])->name('signin.index');
    route::post('/signin', [SigninController::class, 'login1'])->name('signin.post');
    route::get('/signin-pakar', [SigninController::class, 'index2'])->name('signin.pakar.index');
    route::post('/signin-pakar', [SigninController::class, 'login2'])->name('signin.pakar.post');
    route::get('/signup', [SignupController::class, 'index1'])->name('signup.index');
    route::post('/signup', [SignupController::class, 'store1'])->name('signup.post');
    route::get('/signup-pakar', [SignupController::class, 'index2'])->name('pakar.signup.index');
    route::post('/signup-pakar', [SignupController::class, 'store2'])->name('pakar.signup.post');
    Route::post('/getregency', [IndoRegionController::class, 'getregency'])->name('getregency');
    route::post('/admin-pakar', [AdminPakarController::class, 'index']);
    Route::get('/login', function () {
        return view('mainlogin');
    })->name('login');
});
