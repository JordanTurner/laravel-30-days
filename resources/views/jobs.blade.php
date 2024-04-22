<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <x-slot:title>
        Jobs
    </x-slot:title>

    <ul>
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
                <li><strong>{{ $job['title'] }}</strong>: Pays {{ $job['salary'] }} per year</li>
            </a>

        @endforeach
    </ul>
    
</x-layout>