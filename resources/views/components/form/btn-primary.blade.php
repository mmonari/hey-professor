
@props([
    'type' => 'button',
    'label' => null,
])
<button type="submit" class="px-5 py-2.5 mb-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ (($label) ?? $slot) }}</button>