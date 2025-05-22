<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\FeesDetailController;
use App\Http\Controllers\FeesPaymentController;

 /******************************Home************************************* */
 Route::get('/', function () {
    return view('home');
});

Route::get('/student/signup', [StudentLoginController::class, 'showSignupForm'])->name('student.signup');
Route::post('/student/initiate-signup', [StudentLoginController::class, 'initiateSignup'])->name('student.initiate.signup');
Route::post('/student/verify-otp', [StudentLoginController::class, 'verifySignupOTP'])->name('student.verify.otp');
Route::post('/student/complete-signup', [StudentLoginController::class, 'completeSignup'])->name('student.complete.signup');

Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::get('student/login', [LoginController::class, 'showStudentLoginForm'])->name('student.login.form');

Route::get('/check-registration', [StudentLoginController::class, 'checkRegistration'])->name('check.registration');
Route::get('/check-details', [StudentLoginController::class, 'checkDetails'])->name('check.details');

/*-------------------------------------------------------------------------*/
Route::get('/index',"App\Http\Controllers\StudentController@index")->name('admin.panel');



Route::get('/register', [StudentController::class, 'show_register'])->name('register.form');
Route::get('/register/education', [StudentController::class, 'showEducationForm'])->name('register.education.form');
Route::get('/register/desired-course', [StudentController::class, 'showDesiredCourseForm'])->name('register.desired.form');
Route::get('/register/document', [StudentController::class, 'showDocumentForm'])->name('register.document.form');
Route::post('/register', [StudentController::class, 'register'])->name('register.store');
Route::post('/register/education', [StudentController::class, 'registerEducation'])->name('register.education');
Route::post('/register/desired-course', [StudentController::class, 'registerDesiredCourse'])->name('register.desired');
Route::post('/register/document', [StudentController::class, 'registerDocument'])->name('register.document');


Route::get('/courses', [AjaxController::class, 'getCourses']);
Route::get('/specializations/{course_id}', [AjaxController::class, 'getSpecializations']);
Route::get('/schools', [AjaxController::class, 'getSchools']);
Route::get('/countries', [AjaxController::class, 'getCountries']);
Route::get('/states/{country_id}', [AjaxController::class, 'getStates']);
Route::get('/districts/{state_id}', [AjaxController::class, 'getDistricts']);



Route::get('/students', [StudentController::class, 'showStudents'])->name('students.index');



Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');



/****************************Login********************************/

Route::get('/admin/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
Route::post('/adminlogout', [AdminLoginController::class, 'logout'])->name('adminlogout');


Route::get('login', [StudentLoginController::class, 'showStudentLoginForm'])->name('login');
Route::post('login', [StudentLoginController::class, 'studentLogin']);

Route::middleware('checkStudentLogin')->get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');
Route::get('/student/details', [StudentLoginController::class, 'studentDetails'])->name('student.details');

// Route for logging out
Route::post('/logout', [StudentLoginController::class, 'logout'])->name('logout');



//Route for the Print Page
Route::get('student/{id}/print', [StudentController::class, 'print'])->name('students.print');








//........................forgot password....................//
// Forgot Password Routes
Route::get('/forgot-password', [PasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password/check', [PasswordController::class, 'checkEmail'])->name('forgot-password.check');
Route::get('/forgot-password/{email}', [PasswordController::class, 'showResetRequestForm'])->name('forgot-password.form');
Route::post('/forgot-password/verify-otp', [PasswordController::class, 'verifyOtp'])->name('forgot-password.verify-otp');

// Reset Password Routes
Route::get('/reset-password/{email}/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');




//..................................success mail................................//



//--------------------------------------fees-Head------------------------------------//
Route::get('/fees-details/feeshead', [FeesDetailController::class, 'head'])->name('fees-heads.list');
Route::post('/fees-heads', [FeesDetailController::class, 'storeHead'])->name('fees-heads.store');
Route::put('/fees-heads/{id}', [FeesDetailController::class, 'updateHead'])->name('fees-heads.update');
Route::delete('/fees-heads/{id}', [FeesDetailController::class, 'destroyHead'])->name('fees-heads.destroy');




//--------------------------------------fees-Details------------------------------------//
Route::get('/fees-details/details',[FeesDetailController::class, 'list'])->name('fees-details.list');


Route::get('/fees-details/create', [FeesDetailController::class, 'create'])->name('fees-details.create');
Route::post('/fees-details', [FeesDetailController::class, 'store'])->name('fees-details.store');


Route::get('/fees-details/edit/{id}', [FeesDetailController::class, 'edit'])->name('fees-details.edit');
Route::post('/fees-details/get-fees-details', [FeesDetailController::class, 'getFeesDetails'])->name('fees-details.get-fees-details');
Route::put('/fees-details/update/{id}', [FeesDetailController::class, 'update'])->name('fees-details.update');




Route::get('/fees-details/print/{id}', [FeesDetailController::class, 'print'])->name('fees-details.print');



//----------------------------------------------fees-payment-schedules--------------------------------------//

Route::get('/fees-details/feesPaymentSchedule', [FeesDetailController::class, 'paymentSchedule'])->name('fees-details.schedule');
Route::post('/get-structure-amount', [FeesDetailController::class, 'getStructureAmount'])->name('get.structure.amount');
Route::post('/check-structure-schedule', [FeesDetailController::class, 'checkStructureSchedule'])->name('check.structure.schedule');
Route::post('/fees-payment-schedules/feesScheduleStore', [FeesDetailController::class, 'feesScheduleStore'])->name('fees-payment-schedules.feesScheduleStore');



Route::get('/fees-details/fees-schedules', [FeesDetailController::class, 'scheduleList'])->name('fees-schedules.list');
Route::get('/fees-details/fees-schedule-edit/{id}', [FeesDetailController::class, 'editSchedule'])->name('fees-schedules.edit');
Route::put('/fees-payment-schedules/{id}', [FeesDetailController::class, 'updateSchedule'])->name('fees-payment-schedules.update');


Route::get('/fees-details/paymentList', [FeesDetailController::class, 'allPaymentList'])->name('payment.list');
Route::get('/print-invoice/{student_id}/{structure_id}', [FeesDetailController::class, 'printInvoiceByIds'])->name('payment.print');





//---------------------------------------------------Fees-Payment-for-students---------------------------------------------//

Route::get('/students-fees', [FeesPaymentController::class, 'paymentFees'])->name('students.fees');



Route::post('/fees/pay', [FeesPaymentController::class, 'payFees'])
     ->name('fees.pay');
     
Route::get('/invoice/print/{structure}', [FeesPaymentController::class, 'printInvoice'])
     ->name('invoice.print');
