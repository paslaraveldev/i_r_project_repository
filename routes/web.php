<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentgroupController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\AdminConceptController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\StudentProposalController;
use App\Http\Controllers\SupervisorProposalController;
use App\Http\Controllers\StudentProjectReportController;


















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

Route::get('/', [HomeController::class, 'index']);
// registration
Route::get('registration', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'storeRegister'])->name('register.user');
// login
Route::get('login', [AuthController::class, 'login']);
Route::post('logins', [AuthController::class, 'store'])->name('login.student');


Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// forgot password
Route::get('forgotpassword', [AuthController::class, 'forgot']);

Route::post('forgot_post', [AuthController::class, 'forgot_post']);


    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');



Route::resource('courses', CourseController::class);

Route::group(['middleware'=>'supervisor'],function(){ 
 

});


Route::group(['middleware'=>'admin'],function(){ 
    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);

});

Route::group(['middleware'=>'student'],function(){ 
        Route::get('studenthomepage',[DashboardController::class,'dashboard']);
    });

Route::group(['middleware'=>'supervisor'],function(){ 
Route::get('supervisor/dashboard', [DashboardController::class, 'dashboard'])->name('supervisor.dashboard');


});
// admin dashboard routes 

Route::resource('departments', DepartmentController::class);

// Users (CRUD for students, supervisors, and project coordinators)
Route::resource('users', UserController::class);
// group routes 
Route::prefix('groups')->name('groups.')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('index'); // View all groups
    Route::get('/create', [GroupController::class, 'create'])->name('create'); // Create group form
    Route::post('/', [GroupController::class, 'store'])->name('store'); // Store new group

    Route::get('/{group}/assign-supervisor', [GroupController::class, 'assignSupervisorForm'])->name('assign-supervisor'); // Assign supervisor form
    Route::post('/{group}/assign-supervisor', [GroupController::class, 'storeSupervisorAssignment'])->name('assign-supervisor.store'); // Assign a supervisor to a group

    Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('edit'); // Edit group
    Route::put('/{group}', [GroupController::class, 'update'])->name('update'); // Update group details

    Route::get('/{id}', [GroupController::class, 'show'])->name('show'); // Show specific group details

    Route::post('/assign-multiple-supervisors', [GroupController::class, 'assignMultipleSupervisors'])->name('assign-multiple-supervisors'); // Assign multiple supervisors to groups
});









// Concept routes
Route::get('admin/concepts/by-group/{groupId}', [AdminConceptController::class, 'conceptsByGroup'])->name('admin.concepts.byGroup');




// Concept routes
Route::get('admin/concepts/by-group/{groupId}', [AdminConceptController::class, 'conceptsByGroup'])->name('admin.concepts.byGroup');



// admin concept


Route::prefix('admin/concepts')->group(function () {
    Route::get('/', [AdminConceptController::class, 'index'])->name('admin.concepts.index');
    Route::get('/{id}', [AdminConceptController::class, 'show'])->name('admin.concepts.show');
    Route::post('/{id}/accept', [AdminConceptController::class, 'accept'])->name('admin.concepts.accept');
    Route::post('/{id}/reject', [AdminConceptController::class, 'reject'])->name('admin.concepts.reject');
    Route::post('/finalize-rejections', [AdminConceptController::class, 'finalizeRejections'])->name('admin.concepts.finalizeRejections');

    Route::get('/group/{groupId}', [AdminConceptController::class, 'conceptsByGroup'])->name('admin.concepts.byGroup');

});

// project types
Route::resource('project_types', ProjectTypeController::class);






Route::middleware('auth')->group(function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
});






// studentdashboard routes

Route::resource('studentgroups', StudentgroupController::class);
use App\Http\Controllers\StudentConceptController;



Route::resource('concepts', StudentConceptController::class);



Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/profile', [StudentProfileController::class, 'show'])->name('studentprofile.show');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('studentprofile.settings');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('studentprofile.update');



    Route::get('/proposals', [StudentProposalController::class, 'index'])->name('proposals.index');
Route::get('/proposals/create', [StudentProposalController::class, 'create'])->name('proposals.create');
Route::post('/proposals', [StudentProposalController::class, 'store'])->name('proposals.store');
Route::get('/proposals/download/{id}', [StudentProposalController::class, 'download'])->name('proposals.download');
Route::post('/proposals/submit/{id}', [StudentProposalController::class, 'updateStatusToSubmitted'])->name('proposals.submit');
});
// student prposal


Route::get('/proposals', [StudentProposalController::class, 'index'])->name('proposals.index');
Route::get('/proposals/create', [StudentProposalController::class, 'create'])->name('proposals.create');
Route::post('/proposals', [StudentProposalController::class, 'store'])->name('proposals.store');
Route::get('/proposals/download/{id}', [StudentProposalController::class, 'download'])->name('proposals.download');
Route::post('/proposals/submit/{id}', [StudentProposalController::class, 'updateStatusToSubmitted'])->name('proposals.submit');






Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::post('proposals/{id}/update', [StudentProposalController::class, 'update'])->name('student.proposals.update');
});
// Student project report

use App\Http\Controllers\StudentReportController;

Route::middleware(['auth'])->group(function () {
    Route::get('/studentreports/create', [StudentReportController::class, 'create'])->name('studentreports.create');
    Route::post('/studentreports', [StudentReportController::class, 'store'])->name('studentreports.store');
    Route::get('/studentreports', [StudentReportController::class, 'index'])->name('studentreports.index');
    Route::get('/studentreports/download/{id}', [StudentReportController::class, 'download'])->name('studentreports.download');
    Route::post('/studentreports/submit/{id}', [StudentReportController::class, 'updateStatusToSubmitted'])->name('studentreports.submit');
    Route::put('/studentreports/update/{id}', [StudentReportController::class, 'update'])->name('studentreports.update');
});



Route::prefix('supervisor/proposals')->middleware('auth')->group(function () {
    Route::get('/', [SupervisorProposalController::class, 'index'])->name('supervisor.proposals.index');
    Route::get('/{id}', [SupervisorProposalController::class, 'show'])->name('supervisor.proposals.show');
    Route::get('/download/{id}', [SupervisorProposalController::class, 'download'])->name('supervisor.proposals.download');
    Route::post('/upload/{id}', [SupervisorProposalController::class, 'upload'])->name('supervisor.proposals.upload');
    Route::post('/review/{id}', [SupervisorProposalController::class, 'review'])->name('supervisor.proposals.review');
});


use App\Http\Controllers\SupervisorReportController;

// Supervisor Project Report Routes
Route::middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/supervisor/reports', [SupervisorReportController::class, 'index'])->name('supervisor.reports.index');
    Route::get('/supervisor/reports/{id}', [SupervisorReportController::class, 'show'])->name('supervisor.reports.show');
    Route::get('/supervisor/reports/{id}/download', [SupervisorReportController::class, 'download'])->name('supervisor.reports.download');
    Route::post('/supervisor/reports/{id}/upload', [SupervisorReportController::class, 'upload'])->name('supervisor.reports.upload');
    Route::post('/supervisor/reports/{id}/review', [SupervisorReportController::class, 'review'])->name('supervisor.reports.review');
});








