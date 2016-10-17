<?php

use App\Staff;
use App\Photo;
use App\Product;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {

    $staff = Staff::findOrFail(1);

    $staff->photos()->create(['path' => 'example.jpg']);

});

Route::get('/read', function () {

    $staff = Staff::findOrFail(1);

    foreach ($staff->photos as $photo) {

        return $photo->path;

    }

});

Route::get('/update', function () {

    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "Update example.jpg";

    $photo->save();

});

Route::get('/delete', function () {

    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(1)->delete();

});

Route::get('/assign', function () {

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(3);

    $staff->photos()->save($photo);

});

Route::get('/un-assign', function () {

    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(3)->update(['imageable_id' => 0, 'imageable_type' => '']);

});