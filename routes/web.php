<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/foundit/index.php');
});

Route::get('/foundit', function () {
    return redirect('/foundit/index.php');
});