<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Job
    </x-slot:heading>

    <x-slot:title>
        {{ $job->title }} Job
    </x-slot:title>

    <h2 class="font-bold text-lg">{{ $job->title  }}</h2>

    <p>This job pays {{ $job->salary }} per year.</p>

    <!-- if the user can edit the job, show the edit button -->
     <!-- laravel also offers a cannot directive which is the opposite of the can directive. It checks if the user does not have the specified ability. -->
    @can('edit_policy', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id}}/edit">Edit Job</x-button>
        </p>
    @endcan


</x-layout>