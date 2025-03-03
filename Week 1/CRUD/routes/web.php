<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. 
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan 
| ditempatkan dalam grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Rute default untuk halaman utama
Route::get('/', function () {
    return view('welcome'); // Mengembalikan tampilan 'welcome'
});

// Rute resource untuk ItemController, otomatis menangani CRUD
Route::resource('items', ItemController::class);

Route::get('/greeting', [WelcomeController::class, 'greeting']);

Route::get('/world', function () 
        { return 'World';
});

Route::get('/',[HomeController::class,'index']);
Route::get('/about', [AboutController::class,'about']);
Route::get('/articles/{id}', [ArticleController::class,'articles']);

Route::get('/user/{name}', function ($name) { 
    return 'Nama saya ' . $name;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
    });
    

Route::get('/user/{name?}', function ($name='John') { return 'Nama saya '.$name;
    });


Route::resource('photos', PhotoController::class);


    

    
