<?php

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

        Route::get('/', function () {
            return view('welcome');
        });

        Auth::routes();



        Route::group(['middleware'=>['isAdmin','auth']],function(){

            Route::get('/home', 'HomeController@index')->name('home');
            Route::post('/home', 'HomeController@index');


            Route::group(['prefix'=>'ajax'],function(){
            });

            // Campaigns
            Route::resource('campaigns', 'Admin\CampaignController');
            Route::get('/campaigns/{id}/questions/add', 'Admin\CampaignController@addQuestions');
            Route::get('/campaigns/{id}/questions/add/{questionId}', 'Admin\CampaignController@addQuestion');
            Route::post('/campaigns/{id}/questions/add', 'Admin\CampaignController@addQuestionsPost');

            Route::get('/campaigns/{id}/collaborators/add', 'Admin\CampaignController@addCollaborators');
            Route::get('/campaigns/{id}/collaborators/add/{collaboratorId}', 'Admin\CampaignController@addCollaborator');
            Route::post('/campaigns/{id}/collaborators/add', 'Admin\CampaignController@addCollaboratorsPost');

            Route::get('/campaigns/{id}/publish', 'Admin\CampaignController@publishView');
            Route::post('/campaigns/{id}/publish', 'Admin\CampaignController@publishPost');



            // Companies
            Route::resource('companies', 'Admin\CompanyController');

            // Questions
            Route::resource('questions', 'Admin\QuestionController');


        });

        Route::group(['middleware'=>['isUser','auth']],function(){

            Route::get('/user/home', 'User\HomeController@index');
            Route::post('/home', 'User\HomeController@index');

        });
});

