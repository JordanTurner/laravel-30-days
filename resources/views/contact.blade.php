<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Contact Page
    </x-slot:heading>

    <x-slot:title>
        Contact
    </x-slot:title>

    <h1>Hello, from the Contact Page!</h1>
    
</x-layout>