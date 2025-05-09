<?php

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*===========================
=           products           =
=============================*/

Route::apiResource('/products', \App\Http\Controllers\API\ProductsController::class);



/*=====  End of products   ======*/
