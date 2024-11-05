<x-app-layout>

    <x-slot:header>
        
        <x-typo.subtitle>
            {{ __('Dashboard') }}
        </x-typo.subtitle>
        
    </x-slot:header>

    <x-container>
        
      
        <div class="font-medium uppercase dark:text-gray-300">{{ __('Vote on questions') }}</div>

        <form method="get" action="{{ route('dashboard') }}" class="flex flex-row gap-x-2 justify-end items-center">
            <x-text-input name="search" :value="request('search')" placeholder="{{ __('Search') }}" />
            <x-form.btn-primary type="submit" :label="__('Search')" />
        </form>
        
        <div class="mt-2 space-y-3">
            @if($questions->isEmpty())
                <hr class="my-4 border-gray-500 border-dashed">
                <div class="flex flex-col items-center mt-4">
                    <x-typo.subtitle>{{ __('No questions found!') }}</x-typo.subtitle>
                    <a href="{{ route('dashboard') }}" class="ml-2 text-blue-500">{{ __('Browse all questions') }}</a>
                </div>
            @else
                @foreach($questions as $item)
                    <x-question.card :question="$item" />
                @endforeach
            @endif
        </div>
       
        <div class="mt-4">
            {{ $questions->withQueryString()->links() }}
       </div>
       
    </x-container>
    
</x-app-layout>
