<?php

use App\Livewire\ShowBlog;
use App\Livewire\BlogDetail;
use App\Livewire\ShowFaqPage;
use App\Livewire\ShowHome;
use App\Livewire\ShowService;
use App\Livewire\ShowServicePage;
use App\Livewire\ShowTeamPage;
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