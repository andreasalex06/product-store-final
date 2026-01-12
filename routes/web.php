<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\FAQ;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoyaltyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Admin\LandingPageController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'update')->name('profile.update');
    });
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::controller(AdminProductController::class)->group(function () {
        Route::resource('/products', AdminProductController::class);
    });
});

Route::controller(FAQController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegisterForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{product}', 'show')->name('products.show');
});

Route::controller(CartController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{productId}', 'add')->name('cart.add');
        Route::put('/cart/update/{itemId}', 'update')->name('cart.update');
        Route::delete('/cart/remove/{itemId}', 'remove')->name('cart.remove');
    });
});

Route::controller(CheckoutController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout', 'process')->name('checkout.process');

        Route::get('/checkout/now/{product}', 'checkoutNow')
            ->middleware('auth')
            ->name('checkout.now');
    });
});

Route::controller(OrderController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/orders', 'index')->name('orders.index');
        Route::get('/orders/{id}', 'show')->name('orders.show');
    });
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'showForm')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->middleware('guest')->name('email.send');
});

Route::controller(ResetPassword::class)->group(function () {
    Route::get('/reset-password/{token}', 'showForm')->middleware('guest')->name('password.reset');

    Route::post('/reset-password', 'resetPassword')->middleware('guest')->name('password.update');
});

Route::controller(UserManagementController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/admin/users', 'index')->name('admin.users.index');
        Route::delete('/admin/users/{id}', 'destroy')->name('admin.users.destroy');
    });
});

Route::controller(DiscussionController::class)->group(function () {
    // 1. Tampilkan Semua Diskusi (Publik)
    Route::get('/diskusi', 'index')->name('discussions.index');

    // 2. Kirim Pertanyaan (Harus Login)
    Route::post('/diskusi', 'store')
        ->middleware('auth')
        ->name('discussions.store');

    // 3. Kirim Jawaban (Harus Login & Admin)
    Route::put('/diskusi/{id}', 'answer')
        ->middleware('auth')
        ->name('discussions.answer');
});


// Rute untuk menampilkan detail produk (sudah ada di project Anda)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// TAMBAHKAN KODE INI: Rute untuk memproses simpan review
Route::post('/reviews', [ProductReviewController::class, 'store'])->name('review.store');

Route::post('/coupon/apply', [CheckoutController::class, 'applyCoupon'])->name('coupon.apply');


// Kelompokkan rute admin untuk kerapian
Route::prefix('admin')->name('admin.')->group(function () {

    // 1. Rute menuju halaman DAFTAR kupon
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');

    // 2. Rute menuju FORM CREATE kupon (Gunakan GET)
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');

    // 3. Rute untuk PROSES SIMPAN data (Gunakan POST)
    Route::post('/coupons/store', [CouponController::class, 'store'])->name('coupons.store');

    // 4. Rute untuk MENGHAPUS kupon (Gunakan DELETE)
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});

// Rute untuk menghapus kupon yang sudah terpasang
Route::post('/coupon/remove', [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');


Route::middleware(['auth'])->group(function () {
    Route::get('/loyalty', [LoyaltyController::class, 'index'])->name('loyalty.index');
    Route::post('/loyalty/redeem/{reward}', [LoyaltyController::class, 'redeem'])->name('loyalty.redeem');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/loyalty-settings', [AdminSettingController::class, 'index'])->name('loyalty.index');
    Route::post('/loyalty-settings/points', [AdminSettingController::class, 'updatePoints'])->name('loyalty.updatePoints');
    Route::post('/loyalty-settings/rewards', [AdminSettingController::class, 'storeReward'])->name('loyalty.storeReward');
    Route::delete('/loyalty-settings/rewards/{reward}', [AdminSettingController::class, 'destroyReward'])->name('loyalty.destroyReward');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Cukup tulis 'blogs', bukan 'admin/blogs'
    Route::resource('blogs', BlogController::class);
});


Route::get('/blogs', [PublicBlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [PublicBlogController::class, 'show'])->name('blogs.show');


// Group Middleware Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('admin.landing.index');
    Route::post('/landing-page/update', [LandingPageController::class, 'updateSettings'])->name('admin.landing.update');
    Route::post('/landing-page/partner', [LandingPageController::class, 'storePartner'])->name('admin.partner.store');
    Route::delete('/landing-page/partner/{id}', [LandingPageController::class, 'destroyPartner'])->name('admin.partner.destroy');
});
