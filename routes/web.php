<?php

use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\ProtfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;

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



//dashnoard routs -------------------->
Route::get('/dashboard', function () {
    return view('/admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');





//admin Routs ------------------>
Route::controller(AdminController::class)->group(function (){
    Route::get('admin/logout','destroy')->name('admin.logout');
    Route::get('admin/profile','profile')->name('admin.profile');
    Route::get('edit/profile','EditProfile')->name('edit.profile');
    Route::post('store/profile','StoreProfile')->name('store.profile');
    Route::get('change/password','ChangePassword')->name('change.password');
    Route::post('update/password','UpdatePassword')->name('update.password');


});





//about page routs ----------->
Route::controller(AboutController::class)->group(function (){
    Route::get('about/page','AboutPage')->name('about.page');
    Route::post('update/about','UpdateAbout')->name('update.about');
    Route::get('about','HomeAbout')->name('home.about');
    Route::get('about/multi/image','AboutMultiImage')->name('about.multi.image');
    Route::post('store/multi/image','StoreMultiImage')->name('store.multi.image');
    Route::get('all/multi/image','AllMultiImage')->name('all.multi.image');
    Route::get('edit/multi/image/{id}','EditMultiImage')->name('edit.multi.image');
    Route::post('update/multi/image','UpdateMultiImage')->name('update.multi_image');
    Route::get('delete/multi/image/{id}','DeleteMultiImage')->name('delete.multi.image');


});




//protfolio Routs ------------------------------->
Route::controller(ProtfolioController::class)->group(function (){
    Route::get('all/protfolio','AllProtfolio')->name('all.protfolio');
    Route::get('add/protfolio','AddProtfolio')->name('add.protfolio');
    Route::post('store/protfolio','StoreProtfolio')->name('store.protfolio');
    Route::get('edit/protfolio/{id}','EditProtfolio')->name('edit.protfolio');
    Route::post('update/protfolio','UpdateProtfolio')->name('update.protfolio');
    Route::get('delete/protfolio/{id}','DeleteProtfolio')->name('delete.protfolio');
    Route::get('protfolio/details/{id}','ProtfolioDetails')->name('protfolio.details');



});






// Home slide Routs ------------------------>
Route::controller(HomeSliderController::class)->group(function (){
    Route::get('home/slide','HomeSlider')->name('home.slide');
    Route::post('update/slide','UpdateSlider')->name('update.slider');

});





Route::controller(BlogCategoryController::class)->group(function (){
    Route::get('all/blog/category','AllBlogCategory')->name('all.blog.category');
    Route::get('add/blog/category','AddBlogCategory')->name('add.blog.category');
    Route::post('store/blog/category','StoreBlogCategory')->name('store.blog.category');
    Route::get('edit/blog/category/{id}','EditBlogCategory')->name('edit_blog_category');
    Route::post('update/blog/category/{id}','UpdateBlogCategory')->name('update.blog.category');
    Route::get('delete/blog/category/{id}','DeleteBlogCategory')->name('delete.blog.category');





});





Route::controller(BlogController::class)->group(function (){
    Route::get('all/blog','AllBlog')->name('all.blog');
    Route::get('add/blog','AddBlog')->name('add.blog');
    Route::post('store/blog','StoreBlog')->name('store.blog');
    Route::get('edit/blog/{id}','EditBlog')->name('edit.blog');
    Route::post('update/blog','UpdateBlog')->name('update.blog');
    Route::get('delete/blog/{id}','DeleteBlog')->name('delete.blog');
    Route::get('blog/details/{id}','BlogDetails')->name('blog.details');
    Route::get('category/blog/{id}','CategoryBlog')->name('category.blog');
    Route::get('blog','HomeBlog')->name('home.blog');









});




Route::controller(FooterController::class)->group(function (){
    Route::get('footer/setup','FooterSetup')->name('footer.setup');
    Route::post('update/footer','UpdateFooter')->name('update.footer');


});






//
//authentication routs ----------------->
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
