<?php

use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function ()
{
    return Inertia::render('Dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard.index');


/*
    DASHBOARD POST ROUTES || START
*/

    Route::prefix('/dashboard/post')
        ->middleware(['auth', 'verified'])
        ->group(function()
        {
            Route::get('/', [PostController::class, 'index'])->name('dashboard.post.index');
            Route::post('/', [PostController::class, 'store'])->name('dashboard.post.store');
            Route::get('/create', [PostController::class, 'create'])->name('dashboard.post.create');
            Route::get('/{post}', [PostController::class, 'show'])->name('dashboard.post.show');
            Route::patch('/{post}', [PostController::class, 'update'])->name('dashboard.post.update');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('dashboard.post.destroy');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('dashboard.post.edit');
        });

/*
    DASHBOARD POST ROUTES || END
*/

require __DIR__.'/auth.php';
