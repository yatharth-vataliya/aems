<?php
use Illuminate\Support\Facades\Storage;
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

Route::get('/', function () {
	return view('welcome');
});

// Route::get('/',fn() => view('welcome')); as of PHP 7.4 :)

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/getDepartment','CollegeController@getDepartment')->name('getDepartment');

Route::post('/getCourse','CollegeController@getCourse')->name('getCourse');

Route::middleware(['auth'])->group(function(){

	Route::get('/eventShow/{event}','EventController@eventShow')->name('eventShow');
	Route::get('/participantForm','EventParticipantController@participantForm')->name('participantForm');
	Route::post('/registerEventParticipant','EventParticipantController@registerEventParticipant')->name('registerEventParticipant');
	Route::post('/getColleges','CollegeController@getColleges')->name('getColleges');
	Route::post('/getDepartments','CollegeController@getDepartments')->name('getDepartments');
	Route::post('/getCourses','CollegeController@getCourses')->name('getCourses');
	Route::post('/registerEventParticipants','EventParticipantController@registerEventParticipants')->name('registerEventParticipants');
	Route::get('/profile','EventParticipantController@profile')->name('profile');
	Route::get('/removeRegistration/{unique_id}','EventParticipantController@removeRegistration')->name('removeRegistration');
	Route::get('/veiwDetails/{unique_id}','EventParticipantController@viewDetails')->name('viewDetails');
	Route::get('/downloadFile/{unique_id}','EventParticipantController@downloadFile')->name('downloadFile');
	Route::patch('/updateFile','EventParticipantController@updateFile')->name('updateFile');
	Route::get('/deleteMember/{member_id}','EventParticipantController@deleteMember')->name('deleteMember');
	Route::post('/addMember','EventParticipantController@addMember')->name('addMember');

});

Route::middleware(['RedirectIfAdminAuthenticated'])->group(function(){
	Route::get('/admin','AdminController@index')->name('admin');
	Route::post('/adminLogin','AdminController@adminLogin')->name('adminLogin');
});

Route::middleware(['CheckAdmin'])->group(function(){
	Route::resource('/college','CollegeController');
	Route::resource('/event','EventController');
	Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
	Route::get('/adminLogout','AdminController@adminLogout')->name('adminLogout');
	Route::get('/allSoloEvent','EventParticipantController@allSoloEvent')->name('allSoloEvent');
	Route::get('/allGroupEvent','EventParticipantController@allGroupEvent')->name('allGroupEvent');
	Route::get('soloPayFee/{unique_id}','EventParticipantController@soloPayFee')->name('soloPayFee');
	Route::get('/soloUndoPayFee/{unique_id}','EventParticipantController@soloUndoPayFee')->name('soloUndoPayFee');
	Route::get('/groupPayFee/{unique_id}','EventParticipantController@groupPayFee')->name('groupPayFee');
	Route::get('/groupUndoPayFee/{unique_id}','EventParticipantController@groupUndoPayFee')->name('groupUndoPayFee');
	Route::view('/showExcelOptions','excel.show')->name('showExcelOptions');
	Route::get('/generateExcel/{event_id}/{event_type}/{event_name}','ExcelController@generateExcel')->name('generateExcel');
	Route::get('/downloadEventFile/{unique_id}',function($unique_id){
		$file = \App\Models\EventParticipant::where('unique_id',$unique_id)->first();
		// return Storage::download($file->file);
		// response()->download("../storage/app/{$file->file}");
		return Storage::download($file->file);
	})->name('downloadEventFile');

});
