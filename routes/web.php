<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 前台路由
Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\FrontendController::class, 'about'])->name('about');
Route::get('/projects', [\App\Http\Controllers\FrontendController::class, 'projects'])->name('projects');
Route::get('/contact', [\App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');

// 联系表单提交
Route::post('/contact', [\App\Http\Controllers\FrontendController::class, 'submitContact'])->name('contact.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 后台路由（需要登录 + 是 admin）
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/skills', \App\Http\Controllers\Admin\SkillController::class)->except(['show']);
    Route::resource('/experiences', \App\Http\Controllers\Admin\ExperienceController::class)->except(['show']);
    Route::resource('/projects', \App\Http\Controllers\Admin\ProjectController::class)->except(['show']);
    Route::resource('/hobbies', \App\Http\Controllers\Admin\HobbyController::class)->except(['show']);
    Route::resource('/social-links', \App\Http\Controllers\Admin\SocialLinkController::class)
        ->except(['show'])
        ->parameters(['social-links' => 'socialLink']);
    Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::patch('/messages/{message}/toggle-read', [\App\Http\Controllers\Admin\MessageController::class, 'toggleRead'])->name('messages.toggle-read');
    Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');
});

// 切换语言
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'zh'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

require __DIR__.'/auth.php';