<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
    Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/admin/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/admin/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/admin/siswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
});

Route::get('/siswa', [SiswaController::class, 'index']);
// Route::get('/masterproject', [ProjectController::class, 'index']);
Route::get('/mastercontact', [HomeController::class, 'index']);

//@auth
Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('siswa.index');

// Route::get('/admin/project', [ProjectController::class, 'index'])->name('project.index');
// Route::get('/admin/project/create', [ProjectController::class, 'create'])->name('project.create');
// Route::post('/admin/project', [ProjectController::class, 'store'])->name('project.store');
// Route::get('/admin/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
// Route::put('/admin/project/{id}', [ProjectController::class, 'update'])->name('project.update');
// Route::delete('/admin/project/{id}', [ProjectController::class, 'delete'])->name('project.delete');
Route::resource('/admin/project', ProjectController::class);
Route::get('/admin/project/{id}/create', [ProjectController::class, 'add'])->name('project.add');

// Route::get('/admin/contact', [ContactController::class, 'index'])->name('contact.index');
// Route::get('/admin/contact/create', [ContactController::class, 'create'])->name('contact.create');
// Route::post('/admin/contact', [ContactController::class, 'store'])->name('contact.store');
// Route::get('/admin/contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
// Route::put('/admin/contact/{id}', [ContactController::class, 'update'])->name('contact.update');
// Route::delete('/admin/contact/{id}', [ContactController::class, 'delete'])->name('contact.delete');