<?php
use App\Http\Controllers\AplicationControler;
use Illuminate\Support\Facades\Route;

Route::get('{any?}', function () {
    return view('admin.layouts.app');
})->where('any', '.*');
