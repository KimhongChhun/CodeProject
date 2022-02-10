<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FullCalenderController;


  
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
    return view('auth.login');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
  
});

Route::resource('products', ProductController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('product',ProductController::class);
Route::resource('user',UserController::class);

Route::resource('organs',OrganController::class);
Route::resource('organ',OrganController::class);

Route::resource('posts',PostsController::class);

Route::resource('dashboards',DashController::class);
Route::get('/event', [PostController::class, 'index']);

Route::get('calendarAjax', [FullCalenderController::class, 'index']);
Route::post('calendarAjax/action', [FullCalenderController::class, 'action']);
