<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Mail\JobPosted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        // get() -> select *
        //     // use limiting or pagination for larger number of records
        $jobs = Job::with("employer")->latest()->simplePaginate(3);
        return view("jobs.index", ["jobs" => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');

    }

    public function show(Job $job)
    {
        return view("jobs.show", ["job" => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view("jobs.edit", ["job" => $job]);
    }

    public function update(Job $job)
    {
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
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}
