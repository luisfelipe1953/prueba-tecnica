<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;


Route::apiResource('api-users', UserApiController::class)->except('edit', 'create');