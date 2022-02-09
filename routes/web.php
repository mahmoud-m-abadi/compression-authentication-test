<?php

use Illuminate\Support\Facades\Route;

/******* Google Login ******/
Route::get(
    'auth/google/redirect',
    fn(\App\Services\AuthenticationService $service) => $service->login()
);

Route::get(
    'auth/google/callback',
    fn(\App\Services\AuthenticationService $service) => $service->callback()
);
