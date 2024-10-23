<!-- define our custom component's properties so that they are not echoed in the rendered HTML. The active property is passed via each link and is used to determine the active page -->
@props(['active' => false, 'type' => 'a']) 

<{{$type}} class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false'}}" {{ $attributes }} >
    {{ $slot }}
</{{$type}}>
