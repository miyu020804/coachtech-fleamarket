<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function () {

    Route::post(
        '/register',
        [
            AuthController::class,
            'register'
        ]
    )->name('register.store');


    Route::get(
        '/register',
        [
            AuthController::class,
            'showRegisterForm'
        ]
    )->name('register.show');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt ');

// 認証案内
Route::get('email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// 認証リンククリック時
Route::get(
    '/email/verify/{id}/{hash}',
    function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('profile.edit');
    }
)->middleware(['auth', 'signed'])->name('verification.verify');

// 認証メール再送
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [
        MypageController::class,
        'index'
    ])->name('mypage.index');
    Route::get('/mypage/edit', [MypageController::class, 'edit'])->name('mypage.edit');
});

Route::get('/home', fn() =>
'HOME')->name('home');

// 商品一覧画面
Route::get('/', [
    ItemController::class,
    'index'
])->name('items.index');

// 商品検索
Route::get('/items/search', [ItemController::class, 'search'])
    ->middleware('auth')
    ->name('items.search');

// 商品詳細画面
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');

Route::get('/register-done', fn() => '登録OK(仮)');

Route::get(
    '/orders/{item}/purchase',
    [OrderController::class, 'purchase']
)->name('orders.purchase');

Route::post(
    '/items/{item}/comments',
    [CommentController::class, 'store']
)
    ->middleware('auth')
    ->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');
});
