<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SectionController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->middleware('throttle:5,1');

    Route::post('/forget_password', 'forget_password');
    Route::post('/check_forget_code', 'check_forget_code');
    Route::post('/reset_password', 'reset_password');

    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware(['role:SuperAdmin,Admin'])->group(function () {
            Route::post('add_user', 'addUser');
            Route::post('changeRole', 'changeRole');
            Route::post('block', 'block');
            Route::post('update/{id}', 'update');
            Route::get('users', 'index');
            Route::get('blockedUsers', 'blockedUsers');
            Route::get('userRoles/{role_id}', 'userRoles');
        });

        Route::post('logout', 'logout');
        Route::get('/profile', 'profile');
    });
});

Route::controller(SectionController::class)->group(function () {
    Route::prefix('sections')->group(function () {
        Route::get('', 'index');
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer,Assistant'])->group(function () {
            Route::get('/search', 'search');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('/withTrashed', 'indexWithTrashed');
            Route::get('/trashed', 'indexOnlyTrashed');
            Route::post('', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
            Route::get('/restore/{id}', 'restore');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer,Assistant'])->group(function () {
            Route::get('/{id}', 'show');
        });
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('categories')->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('', 'index');
            Route::get('/search', 'search');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::post('', 'store');
            Route::post('/{id}', 'update');
            Route::get('/withTrashed', 'indexWithTrashed');
            Route::get('/trashed', 'indexOnlyTrashed');
            Route::get('/restore/{id}', 'restore');
            Route::delete('/{id}', 'destroy');
        });
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/{id}', 'show');
        });
    });
});

Route::controller(TaskController::class)->group(function () {

    //TaskController Admins Routes :
    Route::get('random-assign', 'randomlyAssign');
    Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
        Route::post('tasks', 'store');
        Route::post('bulktasks', 'bulkstore');
        Route::post('tasks/{id}', 'update');
        Route::delete('tasks/{id}', 'destroy');
    });

    //TaskController Admin Or Trainers Routes :
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('tasks', 'index');
        Route::get('tasks/{id}', 'show');
    });
});

Route::controller(InquiryController::class)->group(function () {
    Route::prefix('inquiries')->group(function () {

        //TaskController Admins Routes :
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('/WithTrashed', 'indexWithTrashed');
            Route::get('/indexOnlyTrashed', 'indexOnlyTrashed');
            Route::post('reassign', 'reassign');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
            Route::get('/restore/{id}', 'restore');
            Route::get('statistics', 'statistics');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer'])->group(function () {
            Route::post('reply', 'reply');
        });

        Route::get('', 'index');
        Route::get('/search', 'search');
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('myinquiries', 'myinquiries');
            Route::get('Status/{status_id}', 'indexStatuses');
            Route::get('Sender/{sender_id}', 'indexSender');
            Route::get('Trainer/{assignee_id}', 'indexTrainer');
            Route::post('repoen/{inq_id}', 'reopen');
            Route::post('', 'store');
        });
        Route::get('/{id}', 'show');
    });
});

Route::controller(FollowupController::class)->group(function () {

    //TaskController Admins Routes :
    Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
        Route::get('followups', 'index');
        Route::post('followups/{id}', 'update');
        Route::delete('followups/{id}', 'destroy');
        Route::get('followups/restore/{id}', 'restore');
    });

    //TaskController Admin Or Trainers Routes :
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('followups')->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show');
            Route::post('', 'store');
        });
        Route::get('followupsrequest/{inquiry_id}', 'followupsrequest');
        Route::get('followupsSection/{section_id}', 'indexSection');
    });
});

Route::controller(FavouriteController::class)->group(function () {

    Route::prefix('favourites')->group(function () {
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show');
        });
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::delete('/{id}', 'remove');
            Route::post('', 'store');
        });
    });

    Route::get('/myFavourites', 'myFavourites')->middleware(['auth:sanctum']);
});

Route::get('/roles', function () {
    return Role::all();
})->middleware(['auth:sanctum', 'role:SuperAdmin,Admin']);
