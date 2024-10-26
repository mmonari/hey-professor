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
        
    </x-container>
    
</x-app-layout>
