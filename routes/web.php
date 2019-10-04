<?php
date_default_timezone_set('Asia/Jakarta');

Route::get('/', function() {

    return redirect(route('admin.phonebook'));

});



Route::get('/kontak', function() {

    return redirect('admin.import');

});



Route::get('home', function() {

    return redirect(route('admin.dashboard'));

});



Route::get('/aktifasi', 'ActivationController@aktifasi');



Route::name('admin.')->prefix('/')->middleware('Login')->group(function() {

    Route::get('topup', 'topupcontroller@index')->name('topup');

    Route::POST('topup', 'confirmcontroller@store');    
    
    Route::POST('topup/payment', 'paymentcontroller@index');

    Route::POST('topup/confirm', 'confirmcontroller@index');

    Route::get('dashboard', 'DashboardController')->name('dashboard');

    Route::get('users', 'UserController@index')->name('users');

    Route::get('notification', 'notificationcontroller@index')->name('notification');    

    Route::get('notification/view/{id}', 'notificationcontroller@show');    

    Route::POST('notification/{id}', 'notificationcontroller@update');

    Route::POST('notification', 'notificationcontroller@updates')->name('multiconfirms');

    Route::POST('notifdeletes', 'notificationcontroller@notifdeletes')->name('notifdeletes');

    Route::put('notification/{id}', 'notificationcontroller@destroy')->name('remove');


    // user
    Route::group(['prefix'=>'profile'], function(){
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('/edit', 'ProfileController@edit')->name('edit-profile');
        Route::get('/password', 'ProfileController@password')->name('password');;
        Route::post('/edit-profile/', 'ProfileController@update_profile');
        Route::post('/password/', 'ProfileController@update_password');
    });

    Route::group(['prefix'=>'kontak/phonebook'], function(){

        Route::get('/', 'PhonebooksController@index')->name('phonebook');

        Route::get('create', 'PhonebooksController@create')->name('create');

        Route::post('deletes', 'PhonebooksController@deletes')->name('deletes');

        Route::post('moves', 'PhonebooksController@moves')->name('moves');

        Route::delete('{phonebook}', 'PhonebooksController@destroy')->name('destroy');

        Route::post('/', 'PhonebooksController@store')->name('store');

        Route::get('{phonebook}/edit', 'PhonebooksController@edit')->name('edit');

        Route::put('{phonebook}', 'PhonebooksController@update')->name('update');

        Route::get('ws_contact', 'PhonebooksController@ws_contact')->name('ws_contact');

        Route::get('import', 'PhonebooksController@import')->name('import');

        Route::post('parse_import', 'PhonebooksController@parse_import')->name('parse_import');

        Route::post('proses_import', 'PhonebooksController@proses_import')->name('proses_import');

        Route::get('export', 'PhonebooksController@export')->name('export');

    });



    Route::group(['prefix'=>'kontak/group'], function(){

        Route::get('/', 'GroupsController@index')->name('group');

        Route::get('/create', 'GroupsController@create')->name('group_create');

        Route::post('/', 'GroupsController@store');

        Route::delete('/{group}', 'GroupsController@destroy');

        Route::get('/{group}/edit', 'GroupsController@edit');

        Route::post('update', 'GroupsController@update');

        Route::post('/deletes', 'GroupsController@deletes');

    });



    Route::group(['prefix'=>'pesan'], function(){

        Route::get('/compose', 'MessagesController@compose')->name('compose');

        Route::post('/send_sms', 'MessagesController@send_sms')->name('send_sms');

        Route::get('/{message}/replay', 'MessagesController@edit')->name('replay');

        Route::post('/send_replay', 'MessagesController@send_replay')->name('send_replay');

        Route::get('/api_getcontact', 'MessagesController@api_getcontact')->name('api_getcontact');



        Route::get('/inbox', 'InboxsController@index')->name('inbox');

        Route::delete('/inbox/{inbox}', 'InboxsController@destroy')->name('destroy_inbox');

        Route::post('/inbox/deletes', 'InboxsController@deletes')->name('inbox_deletes');

        Route::get('/inbox/view/{id}', 'InboxsController@view');
        
        Route::get('/inbox/read/{id}', 'InboxsController@read');



        Route::get('/template', 'TemplateController@index')->name('template');

        Route::get('/template/add', 'TemplateController@add')->name('add-template');

        Route::post('/template/add', 'TemplateController@add_post')->name('kirim-template');

        Route::get('template/edit/{id}', 'TemplateController@edit');

        Route::post('/template/update', 'TemplateController@update')->name('update-template');

        Route::delete('/template/{template}', 'TemplateController@destroy')->name('destroy_template');

        Route::post('/template/deletes', 'TemplateController@deletes')->name('template_deletes');


        Route::get('/outbox', 'OutboxsController@index')->name('outbox');

        Route::delete('/outbox/{outbox}', 'OutboxsController@destroy')->name('destroy_outbox');

        Route::get('/outbox/{outbox}/resend', 'OutboxsController@resend')->name('resend_sms');

        Route::post('/outbox/deletes', 'OutboxsController@deletes')->name('outbox_deletes');





        Route::get('/draft', 'DraftsController@index')->name('draft');

        Route::get('/schedule', 'SchedulesController@index')->name('schedule');

    });



    Route::get('users/roles', 'UserController@roles')->name('users.roles');

    Route::resource('users', 'UserController', [

        'names' => [

            'index' => 'users'

        ]

    ]);


    


});





Route::middleware('Login')->get('admin/logout', function() {

    Auth::logout();

    return redirect(route('masuk'))->withInfo('You have successfully logged out!');

})->name('keluar');



Route::get('admin/login', 'AuthController@login')->name('masuk');

Route::post('admin/login', 'AuthController@loginAction')->name('masukAction');

Route::get('admin/logout', 'AuthController@logout')->name('keluar');



Auth::routes(['verify' => true]);



Route::name('js.')->group(function() {

    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');

});



// Get authenticated user

Route::get('users/auth', function() {

    return response()->json(['user' => Auth::check() ? Auth::user() : false]);

});

