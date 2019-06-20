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
            Route::resource('campaigns', 'CampaignController');
            Route::get('/campaigns/{id}/questions/add', 'CampaignController@addQuestions');
            Route::get('/campaigns/{id}/questions/add/{questionId}', 'CampaignController@addQuestion');
            Route::post('/campaigns/{id}/questions/add', 'CampaignController@addQuestionsPost');

            Route::get('/campaigns/{id}/collaborators/add', 'CampaignController@addCollaborators');
            Route::get('/campaigns/{id}/collaborators/add/{collaboratorId}', 'CampaignController@addCollaborator');
            Route::post('/campaigns/{id}/collaborators/add', 'CampaignController@addCollaboratorsPost');

            Route::get('/campaigns/{id}/publish', 'CampaignController@publishView');
            Route::post('/campaigns/{id}/publish', 'CampaignController@publishPost');



            // Companies
            Route::resource('companies', 'CompanyController');

            // Questions
            Route::resource('questions', 'QuestionController');


        });

        Route::group(['middleware'=>['isUser','auth']],function(){

            Route::get('/user/home', 'HomeController@index');
            Route::post('/home', 'HomeController@index');

        });
});

