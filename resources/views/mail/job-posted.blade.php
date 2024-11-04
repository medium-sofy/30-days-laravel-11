<h2>
{{ $job->title }}
</h2>

<p>
    Congrats! your job is now live on our website
</p>

<p>
    <a href="{{ url('/job/'. $job->id) }}">View your job listing</a>
</p>
