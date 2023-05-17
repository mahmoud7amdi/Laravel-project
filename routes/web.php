<?php

use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\ProtfolioController;

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

Route::get('/', function () {
    return view('frontend.index');
});

Route::controller(AdminController::class)->group(function (){
    Route::get('admin/logout','destroy')->name('admin.logout');
    Route::get('admin/profile','profile')->name('admin.profile');
    Route::get('edit/profile','EditProfile')->name('edit.profile');
    Route::post('store/profile','StoreProfile')->name('store.profile');
    Route::get('change/password','ChangePassword')->name('change.password');
    Route::post('update/password','UpdatePassword')->name('update.password');



});

Route::controller(AboutController::class)->group(function (){
    Route::get('about/page','AboutPage')->name('about.page');
    Route::post('update/about','UpdateAbout')->name('update.about');
    Route::get('about','HomeAbout')->name('home.about');
    Route::get('about/multi/image','AboutMultiImage')->name('about.multi.image');
    Route::post('store/multi/image','StoreMultiImage')->name('store.multi.image');
    Route::get('all/multi/image','AllMultiImage')->name('all.multi.image');
    Route::get('edit/multi/image/{id}','EditMultiImage')->name('edit.multi.image');
    Route::post('update/multi/image','UpdateMultiImage')->name('update.multi_image');
    Route::get('delete/multi/image','DeleteMultiImage')->name('delete.multi.image');




});


Route::controller(ProtfolioController::class)->group(function (){
    Route::get('all/protfolio','AllProtfolio')->name('all.protfolio');
    Route::get('add/protfolio','AddProtfolio')->name('add.protfolio');
    Route::post('store/protfolio','StoreProtfolio')->name('store.protfolio');
    Route::get('edit/protfolio/{id}','EditProtfolio')->name('edit.protfolio');
    Route::post('update/protfolio','UpdateProtfolio')->name('update.protfolio');
    Route::get('delete/protfolio/{id}','DeleteProtfolio')->name('delete.protfolio');
    Route::get('protfolio/details/{id}','ProtfolioDetails')->name('protfolio.details');



});



Route::controller(HomeSliderController::class)->group(function (){
    Route::get('home/slide','HomeSlider')->name('home.slide');
    Route::post('update/slide','UpdateSlider')->name('update.slider');

});


Route::get('/dashboard', function () {
    return view('/admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
