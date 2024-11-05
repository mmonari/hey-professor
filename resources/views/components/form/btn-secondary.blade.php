@props([
        'type' => 'button',
        'label' => null,
         'href' => null,
    ])
@php 
    $class = "inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase bg-white rounded-md border border-gray-300 shadow-sm transition duration-150 ease-in-out dark:bg-gray-800 dark:border-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25";
@endphp
@if($type == 'link')
    <a href="{{$href}}" class="{{ $class }}">{{ (($label) ?? $slot) }}</a>
@else
    <button type="{{$type}}" class="{{ $class }}">{{ (($label) ?? $slot) }}</button>
@endif
