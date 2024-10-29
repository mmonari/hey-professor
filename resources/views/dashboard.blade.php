<x-app-layout>

    <x-slot:header>
        
        <x-typo.subtitle>
            {{ __('Dashboard') }}
        </x-typo.subtitle>
        
    </x-slot:header>

    <x-container>
        
        <x-form.main :action="route('question.store')" >
            
            <x-form.textarea 
                name="question" 
                :label="__('Ask a question:')" 
                placeholder="What's your question?"
                required="true"
            />
            
            <x-form.btn-secondary type="reset" label="Reset" />
            
            <x-form.btn-primary type="submit" label="Ask the question" />

        </x-form.main>

        <hr class="my-4 border-gray-500 border-dashed">
        
        {{-- List of questions --}}
       
        <div class="font-medium uppercase dark:text-gray-300">{{ __('Questions list') }}</div>

        <div class="mt-2 space-y-3">
            @foreach($questions as $item)
                <x-question.card :question="$item" />
            @endforeach
        </div>
       
    </x-container>
    
</x-app-layout>
