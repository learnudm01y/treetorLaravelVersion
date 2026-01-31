<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;
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

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// About Page
Route::get('/about', [PageController::class, 'about'])->name('about');

// Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Search
Route::get('/search', [PageController::class, 'search'])->name('search');

// Services (Frontend)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Blog (Frontend)
Route::get('/blog', [ArticleController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [ArticleController::class, 'show'])->name('blog.show');

// Old dashboard route - redirect to admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin panel routes with authentication middleware
|
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Articles (CRUD)
    Route::resource('articles', AdminArticleController::class);

    // Services (CRUD)
    Route::resource('services', AdminServiceController::class);
    Route::delete('services/{service}/remove-ideal-for', [AdminServiceController::class, 'removeIdealFor'])->name('services.remove-ideal-for');
    Route::delete('services/{service}/remove-feature', [AdminServiceController::class, 'removeFeature'])->name('services.remove-feature');
    Route::delete('services/{service}/remove-benefit', [AdminServiceController::class, 'removeBenefit'])->name('services.remove-benefit');
    Route::delete('services/{service}/remove-quick-feature', [AdminServiceController::class, 'removeQuickFeature'])->name('services.remove-quick-feature');

    // Calendar
    Route::get('/calendar', function () {
        return view('admin.calendar');
    })->name('calendar');

    // Forms
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('/elements', function () {
            return view('admin.forms.elements');
        })->name('elements');
    });

    // Tables
    Route::prefix('tables')->name('tables.')->group(function () {
        Route::get('/basic', function () {
            return view('admin.tables.basic');
        })->name('basic');
    });

    // Pages
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/blank', function () {
            return view('admin.pages.blank');
        })->name('blank');
        Route::get('/404', function () {
            return view('admin.pages.404');
        })->name('404');
    });

    // Charts
    Route::prefix('charts')->name('charts.')->group(function () {
        Route::get('/line', function () {
            return view('admin.charts.line');
        })->name('line');
        Route::get('/bar', function () {
            return view('admin.charts.bar');
        })->name('bar');
    });

    // UI Elements
    Route::prefix('ui')->name('ui.')->group(function () {
        Route::get('/alerts', function () {
            return view('admin.ui.alerts');
        })->name('alerts');
        Route::get('/avatars', function () {
            return view('admin.ui.avatars');
        })->name('avatars');
        Route::get('/badges', function () {
            return view('admin.ui.badges');
        })->name('badges');
        Route::get('/buttons', function () {
            return view('admin.ui.buttons');
        })->name('buttons');
        Route::get('/images', function () {
            return view('admin.ui.images');
        })->name('images');
        Route::get('/videos', function () {
            return view('admin.ui.videos');
        })->name('videos');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
