<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    $jobs = Job::all();
    return view("home");
});

// Index
Route::get("/jobs", function () {
    // get() -> select *
    // use limiting or pagination for larger number of records
    $jobs = Job::with("employer")->latest()->simplePaginate(3);
    return view("jobs.index", ["jobs" => $jobs]);
});

// Create
Route::get("/jobs/create", function () {
    return view('jobs.create');
});

// Show
Route::get("/jobs/{job}", function (Job $job) {
    return view("jobs.show", ["job" => $job]);
});

// Store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

// Edit
Route::get("/jobs/{job}/edit", function (Job $job) {
    return view("jobs.edit", ["job" => $job]);
});

// Update
Route::patch("/jobs/{job}", function (Job $job) {
//Validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
// Authorize {on hold...}

// update the job

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

// redirect
    return redirect("/jobs/" . $job->id);
});

// Destroy
Route::delete("/jobs/{job}", function (Job $job) {
// Authorize {on hold...}
    $job->delete();
    return redirect('/jobs');
});

Route::get("/contact", function () {
    return view("contact");
});
