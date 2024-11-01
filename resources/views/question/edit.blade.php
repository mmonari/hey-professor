<x-app-layout>

    <x-slot:header>
        
        <x-typo.subtitle>
            {{ __('My Questions :: Edit') }}
        </x-typo.subtitle>
        
    </x-slot:header>

    <x-container>
        
        <x-form.main :action="route('question.update', $question)" put>
            
            <x-form.textarea 
                name="question" 
                :label="__('Ask a question:')" 
                placeholder="What's your question?"
                required="true"
                :value="$question->question"
            />
            
            <x-form.btn-secondary type="link" href="{{ route('question.index') }}" label="Back to My Questions" />
            
            <x-form.btn-primary type="submit" label="Save the question" />

        </x-form.main>

        <hr class="my-4 border-gray-500 border-dashed">
       
    </x-container>
    
</x-app-layout>
