<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\DashboardController;

require __DIR__.'/auth.php';

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Language switch route
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');

// Front-end public routes
Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\FrontController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\FrontController::class, 'contact'])->name('contact');
Route::get('/service', [\App\Http\Controllers\FrontController::class, 'services'])->name('service');
Route::get('/blog', [\App\Http\Controllers\FrontController::class, 'blog'])->name('blog');
Route::get('/single-blog', [\App\Http\Controllers\FrontController::class, 'singleBlog'])->name('single-blog');
Route::get('/pricing', [\App\Http\Controllers\FrontController::class, 'pricing'])->name('pricing');
Route::get('/project', [\App\Http\Controllers\FrontController::class, 'project'])->name('project');
Route::get('/team', [\App\Http\Controllers\FrontController::class, 'team'])->name('team');
Route::get('/testimonial', [\App\Http\Controllers\FrontController::class, 'testimonial'])->name('testimonial');
Route::get('/cart', [\App\Http\Controllers\FrontController::class, 'cart'])->name('cart');
Route::get('/checkout', [\App\Http\Controllers\FrontController::class, 'checkout'])->name('checkout');
Route::get('/product-detail', [\App\Http\Controllers\FrontController::class, 'productDetail'])->name('product-detail');
Route::get('/shop', [\App\Http\Controllers\FrontController::class, 'shop'])->name('shop');

// Hosting pages
Route::get('/domain', [\App\Http\Controllers\FrontController::class, 'domain'])->name('domain');
Route::get('/reseller', [\App\Http\Controllers\FrontController::class, 'reseller'])->name('reseller');
Route::get('/shared', [\App\Http\Controllers\FrontController::class, 'shared'])->name('shared');
Route::get('/vps', [\App\Http\Controllers\FrontController::class, 'vps'])->name('vps');
Route::get('/dedicated', [\App\Http\Controllers\FrontController::class, 'dedicated'])->name('dedicated');

// Blog layout pages
Route::get('/load-more', [\App\Http\Controllers\FrontController::class, 'loadMore'])->name('load-more');
Route::get('/one-column', [\App\Http\Controllers\FrontController::class, 'oneColumn'])->name('one-column');
Route::get('/two-column', [\App\Http\Controllers\FrontController::class, 'twoColumn'])->name('two-column');
Route::get('/three-column', [\App\Http\Controllers\FrontController::class, 'threeColumn'])->name('three-column');
Route::get('/three-colum-sidbar', [\App\Http\Controllers\FrontController::class, 'threeColumSidbar'])->name('three-colum-sidbar');
Route::get('/four-column', [\App\Http\Controllers\FrontController::class, 'fourColumn'])->name('four-column');
Route::get('/six-colum-full-wide', [\App\Http\Controllers\FrontController::class, 'sixColumFullWide'])->name('six-colum-full-wide');

// Public search
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');

// Newsletter subscription
Route::post('/newsletter/subscribe', [\App\Http\Controllers\FrontController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

Route::middleware('auth')->group(function () {
    // Authenticated search (if needed, or remove if public is sufficient)
    // Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User management routes
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/toggle-active', [\App\Http\Controllers\UserController::class, 'toggleActive'])->name('users.toggleActive');

    // Customer management routes
    Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');

    // Service management routes
    Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [\App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [\App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [\App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');

    // Company Goal management routes
    Route::get('/company-goals', [\App\Http\Controllers\CompanyGoalController::class, 'index'])->name('company-goals.index');
    Route::post('/company-goals', [\App\Http\Controllers\CompanyGoalController::class, 'store'])->name('company-goals.store');
    Route::put('/company-goals/{companyGoal}', [\App\Http\Controllers\CompanyGoalController::class, 'update'])->name('company-goals.update');
    Route::delete('/company-goals/{companyGoal}', [\App\Http\Controllers\CompanyGoalController::class, 'destroy'])->name('company-goals.destroy');

    // Partner management routes
    Route::get('/partners', [\App\Http\Controllers\PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [\App\Http\Controllers\PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [\App\Http\Controllers\PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [\App\Http\Controllers\PartnerController::class, 'destroy'])->name('partners.destroy');

    // Contact management routes
    Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts', [\App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
    Route::put('/contacts/{contact}', [\App\Http\Controllers\ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [\App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');

    // Testimonial management routes
    Route::get('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', [\App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Blog management routes
    Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
    Route::post('/blogs', [\App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::put('/blogs/{blog}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');

    // Invoice management routes
    Route::get('/invoices', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [\App\Http\Controllers\InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [\App\Http\Controllers\InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [\App\Http\Controllers\InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [\App\Http\Controllers\InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [\App\Http\Controllers\InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [\App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('/invoices/services/list', [\App\Http\Controllers\InvoiceController::class, 'getServices'])->name('invoices.services');
});

