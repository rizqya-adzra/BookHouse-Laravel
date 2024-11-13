<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\IsPelanggan;

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
//login
    Route::middleware('IsGuest')->group(function() {
        Route::get('/', function () {
            return view('user.login');
        })->name('login');
    
        Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
    });

    
    Route::get('/error-permission', function () {
        return view('errors.permission');
    })->name('errors.permission');
    
    Route::middleware(['IsLogin'])->group(function() {
        Route::get('/home', function() {
            return view('landing-page');
        })->name('landing-page');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::middleware(['IsLogin', 'IsAdmin'])->group(function () {
        //data buku
        Route::get('/books', [BookController::class, 'index'])->name('books');
        Route::get('/books/add', [BookController::class, 'create'])->name('books.add');
        Route::post('/books/add', [BookController::class, 'store'])->name('books.add.store');
        Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])->name('books.delete');
        Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::patch('/books/edit/{id}', [BookController::class, 'update'])->name('books.edit.update');
        Route::get('/books/download', [BookController::class, 'downloadPDF'])->name('books.download');
        Route::get('/books/data', [BookController::class, 'data'])->name('books.data');
        
        //akun
        Route::get('/accounts', [UserController::class, 'index'])->name('accounts');
        Route::get('/accounts/add', [UserController::class, 'create'])->name('accounts.add');
        Route::post('/accounts/add', [UserController::class, 'store'])->name('accounts.add.store');
        Route::get('/accounts/edit/{id}', [UserController::class, 'edit'])->name('accounts.edit');
        Route::patch('/accounts/edit/{id}', [UserController::class, 'update'])->name('accounts.edit.update');
        Route::delete('/accounts/delete/{id}', [UserController::class, 'destroy'])->name('accounts.delete');

        Route::get('data', [OrderController::class, 'data'])->name('admin.data');
        Route::get('export/excel', [OrderController::class, 'exportExcel'])->name('export-excel');
    });
    
    Route::middleware(['IsLogin', 'IsPelanggan'])->group(function () {
        Route::prefix('/pelanggan')->name('pelanggan.')->group(function() {
            Route::prefix('/order')->name('order.')->group(function(){
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('/create', [OrderController::class, 'create'])->name('create');
                Route::post('/store', [OrderController::class, 'store'])->name('store');
                Route::get('/print/{id}', [OrderController::class, 'show'])->name('print');
                Route::get('/download/{id}', [OrderController::class, 'downloadPDF'])->name('download');
            });
            Route::prefix('/contact')->name('contact.')->group(function(){
                Route::get('/', [MailController::class, 'index'])->name('index');
            });
            Route::get('/welcome', function () {
                return view('welcome');
            })->name('welcome');
            
        });
    });
    