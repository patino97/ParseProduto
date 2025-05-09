<?php

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return Response::json([
        'name' => 'John Doe',
        'email' => 'teste@gmail.com']);
    });