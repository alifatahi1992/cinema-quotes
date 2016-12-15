<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*main route that show index also optional parameter for user to see all quotes
 from that user*/
Route::get('/{author?}',[
  'uses' => 'QuoteController@getIndex',
  'as'   => 'index'
]);

//route for user form that add quotes
Route::post('/new',[
   'uses' => 'QuoteController@postQuote',
   'as' => 'create'
]);


//Admin Route Group

Route::group(['prefix' => '/admin'], function () {

  //route for get to login page
  Route::get('/login',[
    'uses' => 'AdminController@getLogIn',
    'as'   => 'admin.login'
  ]);

   //route for post from login page
    Route::post('/login',[
      'uses' => 'AdminController@postLogIn',
      'as'   => 'admin.login'
    ]);

    //for logout
    Route::get('/logout',[
      'uses' => 'AdminController@getLogOut',
      'as'   => 'admin.logout'
    ]);

    //grouping route for protect from Not Login users
    Route::group(['middleware'=>'auth'],function(){
      //route for Admin See Latest Quotes
      Route::get('/quotes',[
          'uses' => 'AdminController@getQuotes',
          'as'   => 'admin.quotes'
      ]);
      //route for Admin See Users
      Route::get('/users',[
        'uses' => 'AdminController@getUsers',
        'as'   => 'admin.users'
      ]);

      //route for delete quotes which also need quote_id
      Route::get('/delete/{quote_id}',[
         'uses' => 'AdminController@getDeleteQuote',
         'as' => 'delete'
      ]);

      /*main route that show index also optional parameter for user to see all quotes
       from that user*/
      Route::get('/quotes/{author?}',[
        'uses' => 'AdminController@getQuotes',
        'as'   => 'admin.quotes'
      ]);

    });

});
