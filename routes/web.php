<?php

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

// Route::get('/git', function () {
//     // return response()->streamDownload(function () {
//     //     echo "hello world";
//     // }, 'laravel-readme.md');
    
// });

Route::get('/', function () {
    // return redirect()->away('https://www.google.com');
    // return redirect()->action('StorageModelController@index');
    return view('welcome');
});


Route::resources([
    // 'photos'    => 'PhotoController',
    'posts'     => 'PostController',
]);


// Route::resource('photos', 'PhotoController')
// ->missing(function (Request $request) {
//     return redirect()->route('photos.create');
// });

Route::resource('photos', 'PhotoController')
->only(['index','show','create'])
->names([
    'create' => 'photos.build'
])
->parameters([
    'photos' => 'admin_photo'
])
;

// nested route 
// photos/1/comments/1
Route::resource('photos.comments', 'PhotoCommentController')
;


// this route dependancy injected from route service provider
// Route::get('/posts/{post:slug}', function ($post) {
//     dd($post,'dd');
// });

// ->scoped([
//     'comment' => 'slug',
// ]);

// custom naming route 
// Route::resource('photos', 'PhotoController')->names([
//     'create' => 'photos.build'
// ]);

Route::get('/single-action', 'ProvisionServer');

Route::get('/index', 'StorageModelController@index');

Route::post('/file-upload', 'StorageModelController@onUpload')->name('upload_file');


// this route will work if no route match

// Route::fallback(function () {
//     dd('no route match');
// });


Route::fallback(function () {
    dd('no route match');
})->middleware('throttle:userlimit');
// this middleware use to check user limit from route service provider
