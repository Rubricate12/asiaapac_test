<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('employees.index');
});

// Resourceful route untuk Employee CRUD
Route::resource('employees', EmployeeController::class);
