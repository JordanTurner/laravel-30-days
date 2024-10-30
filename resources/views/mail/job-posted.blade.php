<h2>
    {{ $job->title }}
</h2>

<p>
    Congrats! Your job is now live on our website.
</p>

<p>
    <!-- the url method generates an absolute URL for your app -->
    <a href="{{ url('/jobs/' . $job->id) }}">View Your Job Listing</a>
</p>