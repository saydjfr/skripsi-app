<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckOrder;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrderPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductPage;
use App\Livewire\StatusPesanan;
use App\Livewire\SuccesPage;
use App\Models\product;
use Filament\Pages\Auth\PasswordReset\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}',ProductDetailPage::class );





Route::middleware('guest')->group(function(){
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/resetpassword/{token}', ResetPasswordPage::class)->name('password.reset');
    Route::get('/forgotpassword', ForgotPasswordPage::class)->name('password.request');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        auth()->logout();
        return redirect('/');
    });
    Route::get('/checkout', CheckoutPage::class);
    Route::get('/checkorder',CheckOrder::class);
    Route::get('/status/{nomor_pesanan}', StatusPesanan::class)->name('status');
    Route::get('/succes', SuccesPage::class);
    Route::get('/cancel', CancelPage::class);
    Route::get('/myorders',MyOrderPage::class);
    Route::get('/myorders/{order}', MyOrderDetailPage::class);

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
