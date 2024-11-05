
@props([
    'type' => 'button',
    'label' => null,
])
<button type="{{$type}}" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ (($label) ?? $slot) }}</button>