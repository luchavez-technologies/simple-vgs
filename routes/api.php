<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('inbound', function (Request $request) {
    return customResponse()
        ->success()
        ->data($request)
        ->generate();
});

Route::post('outbound', function (Request $request) {
    return customResponse()
        ->success()
        ->data($request)
        ->generate();
});
