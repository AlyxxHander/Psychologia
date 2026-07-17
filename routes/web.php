<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/**
 * 
 * << Login Routes >>
 * 
 * ------------------------------------------------------------------------------------
 * @Route::post('/login)->name('login.post)
 * @Route::get('/')->name('login') 
 * ------------------------------------------------------------------------------------
 * 
 */
// Login (Default First Route)
Route::middleware('guest')->group(function () {
  Route::post('/login', [AuthController::class, 'login'])->name('login.post');
  Route::get('/', [AuthController::class, 'showLogin'])->name('login');
});


/**
 * 
 * << Landing Page Routes >>
 * 
 * ------------------------------------------------------------------------------------
 * @Route::get('/home')->name('landing.home')
 * @Route::get('/contact-us')->name('landing.contact-us')
 * @Route::get('/news-catalog')->name('landing.news_catalog')
 * @Route::get('/news-detail/{title}')->name('landing.news_detail')
 * ------------------------------------------------------------------------------------
 */
// Landing Page - Home
Route::get('/landing/home', [UserController::class, 'indexLandingPage'])->name('landing.home');
// Landing Page - Contact Us
Route::get('/landing/contact-us', function() {
  return view('landing.contact-us');
})->name('landing.contact-us');
// Landing Page - News Catalog
Route::get('/landing/news-catalog', [UserController::class, 'viewArticleCatalog'])->name('landing.news-catalog');
// Landing Page - News Detail Page
Route::get('/landing/news-detail/{id}/{title}', [UserController::class, 'viewArticle'])->name('landing.news_detail');




/**
 * 
 * << Admin Routes >>
 * 
 * ------------------------------------------------------------------------------------
 * @Route::post('/logout')->name('logout')
 * @Route::get('/admin/dashboard')->name('admin.dashboard')
 * @Route::get('/admin/help-center')->name('admin.help-center')
 * @Route::get('/admin/edit-profile')->name('admin.edit-profile')
 * @Route::get('/admin/article-form')->name('admin.article-form')
 * @Route::get('/admin/manage-members')->name('admin.manage-members')
 * @Route::get('/admin/manage-members/new-member-form')->name('admin.new-member-form')
 * ------------------------------------------------------------------------------------
 * 
 */
Route::middleware('auth')->group(function () {
  /**
   * ------------------------------------------------------------------------------------
   * << Simple Route >>
   * ------------------------------------------------------------------------------------
   */
  // Admin - Dashboard
  Route::get('/admin/dashboard', [AdminController::class, 'viewAdminDashboard'])->name('admin.dashboard');
  // Admin - Help Center
  Route::get('/admin/help-center', [AdminController::class, 'viewHelpCenter'])->name('admin.help-center');
  
  


  /**
   * ------------------------------------------------------------------------------------
   * << ADMIN CRUD >>
   * ------------------------------------------------------------------------------------
   */
  
  // Admin - Update Admin Profile
  Route::put('/admin/edit-admin-profile/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update-admin-profile');
  // Admin - Edit Admin Profile [ GET ]
  Route::get('/admin/edit-profile', [AdminController::class, 'editAdmin'])->name('admin.edit-admin-profile-form');
  



  /**
   * ------------------------------------------------------------------------------------
   * << Members CRUD >>
   * ------------------------------------------------------------------------------------
   */
  // Admin - Add New Member
  Route::post('/admin/manage-members/add-member', [AdminController::class, 'storeNewMember'])->name('admin.add-member');
  // Admin - Logout
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  // Admin - Update Member Profile
  Route::put('/admin/manage-members/update-member-profile/{id}', [AdminController::class, 'updateMember'])->name('admin.update-member-profile');
  // Admin - Delete Member
  Route::delete('/admin/manage-members/delete-member/{id}', [AdminController::class, 'deleteMember'])->name('admin.delete-member');
  
  // Admin - Manage Members [ GET ]
  Route::get('/admin/manage-members', [AdminController::class, 'viewAllMembers'])->name('admin.manage-members');
  // Admin - New Member Form [ GET ]
  Route::get('/admin/manage-members/new-member-form', [AdminController::class, 'createNewMember'])->name('admin.new-member-form');
  // Admin - Edit Member Profile Form [ GET ]
  Route::get('/admin/manage-members/edit-member-profile/{id}', [AdminController::class, 'editMember'])->name('admin.edit-member-profile-form');




  /**
   * ------------------------------------------------------------------------------------
   * << Article CRUD >>
   * ------------------------------------------------------------------------------------
   */
  // Admin - Store New Article
  Route::post('/admin/article-form/add-article/{author_id}', [AdminController::class, 'storeNewArticle'])->name('admin.add-article');
  // Admin - Update Article
  Route::put('/admin/article-form/update-article/{id}', [AdminController::class, 'updateArticle'])->name('admin.update-article');
  // Admin - Delete Article
  Route::delete('/admin/article-form/delete-article/{id}', [AdminController::class, 'deleteArticle'])->name('admin.delete-article');

  // Admin - Manage Articles [ GET ]
  Route::get('/admin/manage-articles', [AdminController::class, 'viewAllArticles'])->name('admin.manage-articles');
  // Admin - New Article Form
  Route::get('/admin/manage-articles/article-form', [AdminController::class, 'createNewArticle'])->name('admin.article-form');
  // Admin - Edit Article Form [ GET ]
  Route::get('/admin/manage-articles/edit-article-form/{id}', [AdminController::class, 'editArticle'])->name('admin.edit-article-form');
});