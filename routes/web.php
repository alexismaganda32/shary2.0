<?php
use App\Models\Post;
use App\Notifications\TestNotificacion;
use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Facades\Socialite;


// $disk = \Storage::disk('gcs');
// $disk -> put ('hola.txt,hola.txt');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(['register' => false, 'verify' => true]);

Route::group(['middleware' => ['public']], function () {

	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::post('/changePersonalInformation', 'ProfileController@changePersonalInformation')->name('changePersonalInformation');
	Route::post('/changePassword', 'ProfileController@changePassword')->name('changePassword');

});

Route::group(['middleware' => ['permission']], function () {

	Route::resource('role', 'RoleController', ['except' => ['show']]);
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::resource('activitylog', 'ActivityLogController', ['only' => ['index']]);
	Route::resource('department', 'DepartmentController', ['except' => ['show']]);
	Route::resource('puesto', 'PuestoController', ['except' => ['show']]);
	Route::resource('social', 'ReasonSocialController', ['except' => ['show']]);
	Route::resource('host', 'HostController', ['except' => ['show']]);
	Route::resource('curso', 'CursoController', ['except' => ['show']]);

    Route::get('assistance/detail', 'AssistanceController@details')->name('assistance.detail');
    Route::resource('assistance', 'AssistanceController', ['except' => ['show']]);

    Route::resource('instructor', 'InstructorController', ['except' => ['show']]);

	
});

// Notification::route('mail', 'taylor@example.com')->notify(new TestNotificacion());


// Route::get('/login-google', function () {
// 	return Socialite::driver('google')->redirect();
// });

// Route::get('/google-callback', function () {
// 	$user = Socialite::driver('google')->user();

// 	// $user->token
// });

// //detalles vistas
// Route::get('/detail', 'AssistanceDetailController@index')->name('detail');
