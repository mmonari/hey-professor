<x-app-layout>

    <x-slot:header>
        
        <x-typo.subtitle>
            {{ __('Dashboard') }}
        </x-typo.subtitle>
        
    </x-slot:header>

    <x-container>
        
        {{-- List of questions to be voted --}}
       
        <div class="font-medium uppercase dark:text-gray-300">{{ __('Vote on questions') }}</div>

        <div class="mt-2 space-y-3">
            @foreach($questions as $item)
                <x-question.card :question="$item" />
            @endforeach
        </div>
       
        <div class="mt-4">
            {{ $questions->withQueryString()->links() }}
       </div>
       
    </x-container>
    
</x-app-layout>
