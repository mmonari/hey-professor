@props(['action', 'verb' => ''])
<x-form.main :action="$action" :verb="$verb" > 
    <button type="submit" {{ $attributes->merge(['class' => 'font-medium text-blue-600 dark:text-blue-500 hover:underline']) }} >
        {{ $slot }}
    </button>
</x-form.main>