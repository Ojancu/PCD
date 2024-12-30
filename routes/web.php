<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\imageController;


Route::get('/', function () {
    return view('start.index');
});

Route::get('/bg_replace', function () {
    return view('image.bg_replace');
})->name('bg_replace');

Route::get('/bg_removal', function () {
    return view('image.bg_removal');
})->name('bg_removal');

Route::post('/remove-bg', [ImageController::class, 'removeBg'])->name('remove.bg');
Route::get('/upload', [ImageController::class, 'showUploadForm'])->name('upload.form');
Route::post('/replace-bg', [ImageController::class, 'replaceBg'])->name('replace.bg');