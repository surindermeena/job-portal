
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CmsController,
    JobController,
    PDFController,
    UserController,
    AdminController,
    CommonController,
    CompanyController,
    CategoryController,
    CandidateController,
    ContactusController,
    ApplicationController,
    TestimonialController,
    ResetPasswordController
};
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// -------------------------- General Pages ------------------------------------------- 

Route::controller(CommonController::class)
    ->name('frontside.')
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/faq', 'faq')->name('faq');
        Route::get('/terms', 'terms')->name('terms');
        Route::get('/companies', 'companies')->name('companies');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/howitwork', 'howItWork')->name('howitwork');
        Route::get('/jobs', 'jobs')->name('jobs');
        Route::get('/singleCompany/{id}', 'singleCompany')->name('singleCompany');
        Route::get('/singleJob/{id}', 'singleJob')->name('singleJob');
        Route::get('/jobs/{city}', 'jobByCity')->name('jobByCity');
        Route::get('/jobs/category/{cat}', 'jobByCat')->name('jobByCat');
    });

// -------------------------- Auth -------------------------------------------

Route::get('/login', [UserController::class, "login"])->name('login');
Route::post('/login', [UserController::class, "loginSave"])->name('loginSave');
Route::post('/register', [UserController::class, "registerSave"])->name('registerSave');
Route::get('/logout', [UserController::class, "logout"])->name('logout');

// Change password inside dashboard (user logged in)
Route::get('/change-password', [UserController::class, "changePassword"])->name('view.changePassword');
Route::post('/change-password', [UserController::class, 'changePasswordSubmit'])->name('changePasswordSubmit');

// Forgot password (user NOT logged in, public)
Route::post('/forgot-password', [UserController::class, 'forgetPw'])->name('password.email');

// Reset password (from email link)
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/forgot-password', [UserController::class, 'showForgetForm'])->name('password.request');

// -------------------------- Candidate -------------------------------------------

Route::prefix('candidate')->group(function () {
    Route::get('/detail', [CandidateController::class, "index"])->name('candidate.detail');
    Route::get('/edit', [CandidateController::class, "edit"])->name('candidate.edit');
    Route::put('/update/{id}', [CandidateController::class, "update"])->name('candidate.update');
    Route::get('/applied-jobs', [CandidateController::class, "appliedJob"])->name('candidate.appliedJob');
    Route::get('/resume', [CandidateController::class, "candidateResume"])->name('candidate.candidateResume');
    Route::post('/documents-store', [CandidateController::class, 'storeFiles'])->name('documents.store');
    Route::delete('/documents/{document}', [CandidateController::class, 'destroy'])->name('documents.destroy');

    // when user click on btn in single_job_detail
    Route::get('/jobapply/{id}', [CandidateController::class, "jobapply"])->name('jobapply');
});

// -------------------------- Company -------------------------------------------

Route::prefix('company')->group(function () {
    Route::get('/detail', [CompanyController::class, "index"])->name('company.detail');
    Route::get('/edit', [CompanyController::class, "edit"])->name('company.edit');
    Route::put('/update/{id}', [CompanyController::class, "update"])->name('company.update');

    //-------------- Job Route START-----------------------
    Route::get('/manage-job', [JobController::class, "index"])->name('job.manageJob');
    Route::get('/job/status/{id}', [JobController::class, 'toggleStatus'])->name('job.toggleStatus');
    Route::get('/job-create', [JobController::class, "createJob"])->name('create.job');
    Route::post('/job-create', [JobController::class, "store"])->name('job.store');
    Route::get('/job-detail/{id}', [JobController::class, "jobDetail"])->name('job.detail');
    Route::get('/job-edit/{id}', [JobController::class, "editJob"])->name('job.edit');
    Route::put('/job-update/{id}', [JobController::class, "update"])->name('job.update');
    Route::get('/job-delete/{id}', [JobController::class, "destroy"])->name('job.delete');
    //-------------- Job Route END-----------------------

    Route::get('/applied-candidate', [CompanyController::class, "appliedCandidate"])->name('company.appliedCandidate');
    Route::get('/applied-candidate-detail/{id}', [CompanyController::class, "candidateDetail"])->name('applied.candidate.detail');
    Route::post('/sendmessage', [CompanyController::class, "sendMessage"])->name('send.message');
});

// -------------------------- Admin -------------------------------------------

Route::prefix('admin')->group(function () {
    Route::get('/', [CommonController::class, "adminDetail"])->name('admin.index');
    Route::get('/profile-edit', [CommonController::class, "adminProfileEdit"])->name('admin.profie.edit');
    Route::put('/profile-update/{id}', [CommonController::class, "adminProfileUpdate"])->name('admin.detail.update');

    // CMS

    Route::get('/cms', [CmsController::class, 'index'])->name('admin.cms');
    Route::post('/terms/update', [CmsController::class, 'termsUpdate'])->name('terms.update');
    Route::post('/faqs/update', [CmsController::class, 'faqUpdate'])->name('faqs.update');
    Route::post('/about/update', [CmsController::class, 'aboutUpdate'])->name('about.update');

    // Testimonials

    Route::get('/testimonial', [TestimonialController::class, "index"])->name('admin.testimonial');
    Route::get('/testimonial-create', [TestimonialController::class, "create"])->name('view.admin.testimonial.create');
    Route::post('/testimonial-store', [TestimonialController::class, "store"])->name('admin.testimonial.store');
    Route::get('/testimonial-edit/{id}', [TestimonialController::class, "edit"])->name('admin.testimonial.edit');
    Route::put('/testimonial-edit/{id}', [TestimonialController::class, "update"])->name('admin.testimonial.update');
    Route::get('/testimonials/status/{id}', [TestimonialController::class, 'toggleStatus'])->name('testimonial.toggleStatus');
    Route::get('/testimonial-delete/{id}', [TestimonialController::class, "destroy"])->name('admin.testimonial.delete');

    // Categories

    Route::get('/categories', [CategoryController::class, "index"])->name('category.index');
    Route::get('/categories1', [CategoryController::class, "index"])->name('admin.category.index');
    Route::get('/category/create', [CategoryController::class, "create"])->name('create.category');
    Route::post('/category/store', [CategoryController::class, "store"])->name('create.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, "edit"])->name('admin.category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/status/{id}', [CategoryController::class, 'toggleStatus'])->name('category.toggleStatus');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    // Applications

    Route::get('/applications', [ApplicationController::class, "index"])->name('applications.index');

    // Candidates

    Route::get('/candidates', [CandidateController::class, "adminCandidate"])->name('admin.candidates.index');

    // Users

    Route::get('/user-index', [UserController::class, "index"])->name('user.index');
    Route::get('/user/applied', [UserController::class, "appliedUsers"])->name('user.appliedUsers');
    Route::get('/user-details/{id}', [UserController::class, "userDetails"])->name('user.details');
    Route::get('/applied-user-details/{id}', [UserController::class, "appliedUserDetails"])->name('applied.user.details');

    // Companies

    Route::get('/companies', [JobController::class, "adminCompany"])->name('admin.companies');
    Route::get('/company/status/{id}', [JobController::class, 'companyToggleStatus'])->name('company.toggleStatus');
    Route::get('/company/create', [AdminController::class, 'createCompany'])->name('view.create.company');

    Route::post('/company/store', [CompanyController::class, 'store'])->name('Company.create.store');
    Route::get('/company/edit/{id}', [CompanyController::class, 'editCompany'])->name('view.edit.company');

    // Contact messages
    Route::get('/contact-message', [ContactusController::class, 'index'])->name('admin.contactUs');
    Route::get('/contact-message-delete-all', [ContactusController::class, 'destroyAll'])->name('admin.contactus.delete.all');
    Route::get('/contact-message-delete-single/{id}', [ContactusController::class, 'destroySingle'])->name('admin.delete.single');
});

// -------------------------- Utilities --------------------------

Route::get('/user/{id}/download-cv', [PDFController::class, 'downloadCV'])->name('user.download.cv');
Route::post('/contact', [ContactusController::class, 'store'])->name('contact.store');

// -------------------------- SiteMap --------------------------

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/jobs'))
        ->add(Url::create('/contact'));
    return $sitemap->toResponse(request());
})->name('website.sitemap');

// -------------------------- Fallback -------------------------------------------

Route::fallback(fn() => response()->view('frontside.404', [], 404));
