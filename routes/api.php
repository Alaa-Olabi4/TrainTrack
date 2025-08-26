<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RatingController;
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
    Route::post('login', 'login')->middleware('throttle:5,1'); //1
    Route::post('login/mobile', 'loginMobile')->middleware(['throttle:5,1']); //1
    Route::post('/forget_password', 'forget_password'); //1
    Route::post('/check_forget_code', 'check_forget_code'); //1
    Route::post('/reset_password', 'reset_password'); //1

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::middleware(['role:SuperAdmin,Admin'])->group(function () {
            Route::post('add_user', 'addUser'); //1
            Route::post('changeRole', 'changeRole'); //1
            Route::post('block', 'block'); //1
            Route::post('updateProfile/{id}', 'update'); //1
            Route::get('users', 'index'); //1
            Route::get('blockedUsers', 'blockedUsers'); //1
            Route::get('userRoles/{role_id}', 'userRoles'); //1
        });

        Route::post('logout', 'logout'); //1
        Route::get('/profile', 'profile'); //1
    });
    Route::get('users/search', 'search'); //1
});

Route::controller(SectionController::class)->group(function () {
    Route::prefix('sections')->group(function () {
        Route::get('', 'index'); //1
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer,Assistant'])->group(function () {
            Route::get('/search', 'search'); //1
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('/withTrashed', 'indexWithTrashed'); //1
            Route::get('/trashed', 'indexOnlyTrashed'); //1
            Route::post('', 'store'); //1
            Route::post('/{id}', 'update'); //1
            Route::delete('/{id}', 'destroy'); //1
            Route::get('/restore/{id}', 'restore'); //1
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer,Assistant'])->group(function () {
            Route::get('/{id}', 'show'); //1
        });
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('', 'index'); //1
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/search', 'search'); //1
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::post('', 'store'); //1
            Route::post('/{id}', 'update'); //1
            Route::get('/indexNoOwner', 'indexNoOwner'); //1
            Route::get('/withTrashed', 'indexWithTrashed'); //1
            Route::get('/trashed', 'indexOnlyTrashed'); //1
            Route::get('/restore/{id}', 'restore'); //1
            Route::delete('/{id}', 'destroy'); //1
        });
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/{id}', 'show'); //1
        });
    });
});

Route::controller(TaskController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
        Route::get('random-assign', 'randomlyAssign');
        Route::post('bulktasks', 'bulkstore');

        Route::prefix('tasks')->group(function () {
            Route::post('', 'store');
            Route::post('/{id}', 'update');
            Route::get('/reset', 'reset');
            Route::get('/reset/{id}', 'reset1');
        });
    });

    //TaskController Admin Or Trainers Routes :
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('tasks', 'index');
        Route::get('tasks/{id}', 'show');
    });
});

Route::controller(InquiryController::class)->group(function () {
    Route::prefix('inquiries')->group(function () {
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('/WithTrashed', 'indexWithTrashed');
            Route::get('/indexOnlyTrashed', 'indexOnlyTrashed');
            Route::post('reassign', 'reassign');
            // Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
            Route::get('/restore/{id}', 'restore');
            Route::get('statistics', 'statistics');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer'])->group(function () {
            Route::post('reply', 'reply');
        });

        Route::get('/search', 'search');
        Route::get('', 'index');
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('myinquiries', 'myinquiries');
            Route::get('Status/{status_id}', 'indexStatuses');
            Route::get('Sender/{sender_id}', 'indexSender');
            Route::get('Trainer/{assignee_id}', 'indexTrainer');
            Route::post('/reopen', 'reopen');
            Route::post('', 'store');
        });
        Route::get('/{id}', 'show');
    });
});

Route::controller(FollowupController::class)->group(function () {

    Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
        Route::get('followups/restore/{id}', 'restore');
    });

    //TaskController Admin Or Trainers Routes :
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('followups')->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show');
            Route::post('', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
        Route::get('followupsrequest/{inquiry_id}', 'followupsrequest');
        Route::get('followupsSection/{section_id}', 'indexSection');
    });
});

Route::controller(FavouriteController::class)->group(function () {
    Route::prefix('favourites')->group(function () {
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin'])->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show'); ///0
        });
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::delete('/{id}', 'remove');
            Route::post('', 'store');
        });
    });

    Route::get('/myFavourites', 'myFavourites')->middleware(['auth:sanctum']);
});

Route::controller(ReportController::class)->group(function () {
    Route::prefix('reports')->group(function () {
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer'])->group(function () {
            Route::post('system', 'SystemReport');
            Route::post('systemExcel', 'SystemReportExcel');
            Route::post('category', 'categoryReport');
            Route::post('categoryExcel', 'CategoryReportExcel');
            Route::post('myDailyReport', 'myDailyReport');
            Route::post('myWeeklyReport', 'myWeeklyReport');
            Route::post('myMonthlyReport', 'myMonthlyReport');
        });
        Route::post('trainers', 'TrainerReport');
        Route::get('trainers', 'Trainers');
    });
});

Route::controller(NotificationController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('notifications')->group(function () {
            Route::get('', 'index');
            Route::get('myNotifications', 'myNotifications');
            Route::get('setRead/{notification_id}', 'setRead'); ///0
        });
    });
});

Route::controller(RatingController::class)->group(function () {
    Route::prefix('ratings')->group(function () {
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer'])->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show');
            Route::get('/user',  'userRatings');
            Route::get('/admin', 'adminRatings');
        });
        Route::middleware(['auth:sanctum', 'role:SuperAdmin,Admin,User'])->group(function () {
            Route::post('', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });
});

Route::get('/roles', function () {
    return Role::all();
})->middleware(['auth:sanctum', 'role:SuperAdmin,Admin,Trainer',]);
