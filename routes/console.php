<?php

use Illuminate\Support\Facades\{Artisan, Schedule};

Schedule::call(function () {
    Artisan::command('model:prune');
})->daily();
