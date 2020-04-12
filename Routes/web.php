<?php

Route::post('logout', 'LoginController@logout')
    ->name('user.logout');