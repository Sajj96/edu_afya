<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function ()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_USERS_VIEW);
        Route::get('/view/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.details')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_USERS_VIEW);
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\UserController::class,'add'])->name('user.create')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_USER_ADD);
        Route::match(['get', 'post'], '/edit/{id?}', [\App\Http\Controllers\UserController::class,'edit'])->name('user.edit')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_USER_EDIT);
        Route::delete('/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_USER_DELETE);
    });

    Route::prefix('/roles')->group(function () {
        Route::get('/', [\App\Http\Controllers\RoleController::class,'index'])->name('role')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_ROLES_VIEW);
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\RoleController::class,'add'])->name('role.create')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_ROLE_ADD);
        Route::match(['get', 'post'], '/edit/{id?}', [\App\Http\Controllers\RoleController::class,'edit'])->name('role.edit')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_ROLE_EDIT);
        Route::post('/delete', [\App\Http\Controllers\RoleController::class,'deleteRole'])->name('role.delete')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_ROLE_DELETE);
    });

    Route::group(['prefix' => 'doctors'], function(){
        Route::get('/', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctor')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTORS_VIEW);
        Route::get('/view/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('doctor.details')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTORS_VIEW);
        Route::get('/edit/{id?}', [\App\Http\Controllers\DoctorController::class,'edit'])->name('doctor.edit')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTOR_EDIT);
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\DoctorController::class,'add'])->name('doctor.create')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTOR_ADD);
        Route::post('/update', [\App\Http\Controllers\DoctorController::class,'update'])->name('doctor.update')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTOR_EDIT);
        Route::delete('/delete', [App\Http\Controllers\DoctorController::class, 'delete'])->name('doctor.delete')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_DOCTOR_DELETE);
    });

    Route::group(['prefix' => 'chats'], function(){
        Route::get('/', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');
    });

    Route::group(['prefix' => 'videos'], function(){
        Route::get('/', [App\Http\Controllers\VideoController::class, 'index'])->name('video')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_VIDEOS_VIEW);
        Route::get('/view/{id}', [App\Http\Controllers\VideoController::class, 'show'])->name('video.details')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_VIDEOS_VIEW);
        Route::match(['get', 'post'], '/edit/{id?}', [\App\Http\Controllers\VideoController::class,'edit'])->name('video.edit')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_VIDEO_EDIT);
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\VideoController::class,'add'])->name('video.create')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_VIDEO_ADD);
        Route::delete('/delete', [App\Http\Controllers\VideoController::class, 'delete'])->name('video.delete')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_VIDEO_DELETE);
    });

    Route::group(['prefix' => 'video-categories'], function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('video.category')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_CATEGORIES_VIEW);
        Route::match(['get', 'post'], '/edit/{id?}', [\App\Http\Controllers\CategoryController::class,'edit'])->name('video.category.edit')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_CATEGORY_EDIT);
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\CategoryController::class,'add'])->name('video.category.create')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_CATEGORY_ADD);
        Route::delete('/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('video.category.delete')->middleware("permission:" . \App\Models\PermissionSet::PERMISSION_CATEGORY_DELETE);
    });

    Route::group(['prefix' => 'doctor-categories'], function(){
        Route::get('/', [App\Http\Controllers\DoctorCategoryController::class, 'index'])->name('doctor.category');
        Route::match(['get', 'post'], '/edit/{id?}', [\App\Http\Controllers\DoctorCategoryController::class,'edit'])->name('doctor.category.edit');
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\DoctorCategoryController::class,'add'])->name('doctor.category.create');
        Route::delete('/delete', [App\Http\Controllers\DoctorCategoryController::class, 'delete'])->name('doctor.category.delete');
    });

    Route::group(['prefix' => 'comments'], function(){
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\CommentController::class,'add'])->name('comment.create');
        Route::post('/reply', [\App\Http\Controllers\CommentController::class,'reply'])->name('comment.reply');
        Route::delete('/delete', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
    });

    Route::group(['prefix' => 'transactions'], function(){
        Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
    });

    Route::group(['prefix' => 'reports'], function(){
        Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    });

    Route::group(['prefix' => 'banners'], function(){
        Route::get('/', [App\Http\Controllers\VideoSliderController::class, 'index'])->name('banner');
        Route::match(['get', 'post'], '/create', [\App\Http\Controllers\VideoSliderController::class,'create'])->name('banner.create');
        Route::delete('/delete', [App\Http\Controllers\VideoSliderController::class, 'delete'])->name('banner.delete');
    });
});
