<?php

Route::get('login', 'LoginController@showLoginForm')
    ->name('user.showLoginForm');
Route::post('login', 'LoginController@login')
    ->name('user.login');

Route::get('register', 'RegisterController@showRegistrationForm')
    ->name('user.registerForm');
Route::post('register', 'RegisterController@register')
    ->name('user.register');

Route::get('password-request', 'ForgotPasswordController@showLinkRequestForm')
    ->name('user.password.request');
Route::post('password-request', 'ForgotPasswordController@sendResetLinkEmail')
    ->name('user.password.email');

Route::get('password-reset', 'ResetPasswordController@showResetForm')
    ->name('user.password.reset');
Route::post('password-reset', 'ResetPasswordController@reset')
    ->name('user.password.update');