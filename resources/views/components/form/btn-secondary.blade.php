@props([
        'type' => 'button',
        'label' => null,
    ])
<button type="{{$type}}" class="px-5 py-2.5 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ (($label) ?? $slot) }}</button>
