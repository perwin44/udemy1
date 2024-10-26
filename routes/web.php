<?php

use App\DataTables\UsersDataTable;
use App\Events\UserRegistered;
use App\Helpers\ImageFilter;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendMail;
use App\Mail\PostPublished;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

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
    return view('welcome');
});

Route::get('/dashboard', function (UsersDataTable $dataTable) {
    // $users=User::paginate(10);
    // return view('dashboard',compact('users'));
    return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group(['middleware'=>'auth'],function(){
    Route::get('/posts/trash',[PostController::class,'trashed'])->name('posts.trashed');
    Route::get('/posts/{id}/restore',[PostController::class,'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete',[PostController::class,'forceDelete'])->name('posts.forceDelete');
    
    Route::resource('posts',PostController::class);
});


Route::get('user-data',function(){
    //return Auth::user()->name;
    return auth()->user()->email;
});

Route::get('send-mail',function(){
    SendMail::dispatch();
    dd('mail has been send');
});

Route::get('user-register',function(){
    $email='pnonjida@gmail.com';
    event(new UserRegistered($email));
    dd('mail has been send');
});
//en,hi
Route::get('greeting/{locale}',function($locale){
    App::setLocale($locale);
    return view('greeting');
})->name('greeting');

Route::get('image',function(){
    // $img=Image::read('new.jpg');
    //$manager=new ImageManager(new Driver());
    $img = ImageManager::make('new.jpg');
    //$img->filter(new ImageFilter(5));
     $img->crop(400,400);
    // $img->blur(15);
    // $img->greyscale();
     $img->save('new1.jpg',80);
    //return $img->response();
});