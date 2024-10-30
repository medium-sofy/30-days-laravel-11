<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    $jobs = Job::all();
    return view("home");
});

Route::get("/jobs", function () {
    // get() -> select *
    // use limiting or pagination for larger number of records
    $jobs = Job::with('employer')->get();
    return view("jobs", ["jobs" => $jobs]);
});

Route::get("/jobs/{id}", function ($id) {
    $job = Job::find($id);
    return view("job", ["job" => $job]);
});

Route::get("/contact", function () {
    return view("contact");
});
