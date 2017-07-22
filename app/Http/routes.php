<?php

Route::group(['middleware' => 'onlyAjax'], function () {
    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->get('register', 'Auth\AuthController@showRegistrationForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->post('register', 'Auth\AuthController@register');
    $this->get('logout', 'Auth\AuthController@logout');
    
    Route::post('/getGameInformation', 'DefaultController@getGameInformation');
});

$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');

Route::get('/', 'DefaultController@renderPage');

//------------------------- Movaghtan ---------------------------

Route::post('/reserve_user','DefaultController@reservedgameforuser');
//--------------------------------------------------------------------
Route::group(['middleware' => 'onlyAjax'], function () {
    Route::post('/news', 'DefaultController@getNews');
    Route::get('/drawtimetable', 'DefaultController@drawTableReservation');
    Route::post('/sendmessage','DefaultController@sendEmail');

});

Route::post('/userProfileEdit','DefaultController@userUpdate');

Route::get('admin_no_auth', function () {
    abort(403);
});

Route::any('/sendDataBank','callBackController@sendDataToBank');
Route::any('/callBackRequest','callBackController@requestCallback');



Route::group(['prefix' => 'admin', 'middleware' => 'adminChecker'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('games', 'Admin\\GamesController');
    Route::resource('users', 'Admin\\UsersController');
    Route::resource('roles', 'Admin\\RolesController');
    Route::resource('slider', 'Admin\\SliderController');
    Route::resource('reservations', 'Admin\\ReservationsController');
    Route::resource('transactions', 'Admin\\TransactionsController');

    Route::group(['middleware' => 'onlyAjax'], function () {
        Route::post('/games/changeActivate', 'Admin\\GamesController@changeActivate');
        Route::post('/posts/changeActivate', 'Admin\\PostsController@changeActivate');
        Route::post('/dashboard/sendemail', 'Admin\\DashboardController@sendEmail');
        Route::post('/renderSelect', 'Admin\\ReservationsController@drawOptionsTimesOnDate');
        Route::post('/reservations/changeActivate', 'Admin\\ReservationsController@changeActivate');
        Route::post('/reservations/changeCancel', 'Admin\\ReservationsController@changeCancel');

    });
    Route::get('/reservations/orderedactivate/{ordered}', 'Admin\\ReservationsController@orderByActivate');

    Route::get('/dashboard', 'Admin\\DashboardController@index');
    Route::resource('/settings', 'Admin\\SettingsController');
    Route::resource('/posts', 'Admin\\PostsController');

});






