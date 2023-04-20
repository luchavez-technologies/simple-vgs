<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('inbound', function (Request $request) {
    return simpleResponse()
        ->success()
        ->data($request)
        ->generate();
});

Route::post('outbound', function (Request $request) {
    return simpleResponse()
        ->success()
        ->data($request)
        ->generate();
});
