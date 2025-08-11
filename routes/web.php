<?php

use App\Livewire\ShowBlog;
use App\Livewire\BlogDetail;
use App\Livewire\ShowFaqPage;
use App\Livewire\ShowContactPage;
use App\Livewire\ShowHome;
use App\Livewire\ShowPage;
use App\Livewire\ShowService;
use App\Livewire\ShowServicePage;
use App\Livewire\ShowTeamPage;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ShowHome::class)->name('home');
Route::get('/services', ShowServicePage::class)-> name('servicesPage');
Route::get('/service/{id}', ShowService::class)-> name('servicePage');
Route::get('/team', ShowTeamPage::class)-> name('teamPage');
Route::get('/blog', ShowBlog::class)-> name('blog');
Route::get('/blog/{id}', BlogDetail::class)-> name('blogDetail');
Route::get('/faqs', ShowFaqPage::class)-> name('faqs');
Route::get('/page/{id}', ShowPage::class)-> name('page');
Route::get('/aboutus', ShowPage::class)->defaults('id', 7)->name('aboutus');
Route::get('/privacy-policy', ShowPage::class)->defaults('id', 8)->name('privacy-policy');
Route::get('/term-conditions', ShowPage::class)->defaults('id', 9)->name('term-conditions');
Route::get('/contact', ShowContactPage::class)-> name('contact');
Route::get('/invoice/{id}/pdf', [InvoiceController::class, 'exportPdf'])->name('invoice.pdf');
