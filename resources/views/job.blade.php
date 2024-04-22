<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Job
    </x-slot:heading>

    <x-slot:title>
        {{ $job['title'] }} Job
    </x-slot:title>

    <h2 class="font-bold text-lg">{{ $job['title']  }}</h2>

    <p>This job pays {{ $job['salary'] }} per year.</p>

</x-layout>