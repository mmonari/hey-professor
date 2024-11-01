<x-app-layout>

    <x-slot:header>
        
        <x-typo.subtitle>
            {{ __('My Questions') }}
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
        
        <x-typo.h3 class="mb-2">{{ __('Drafts') }}</x-typo.h3>

        <x-table.main>
            <x-table.thead>
                <tr>
                    <x-table.th>
                        Question
                    </x-table.th>
                    <x-table.th>
                        &nbsp;
                    </x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach($questions->where('draft', true) as $item)
                    <x-table.tr>
                        <x-table.td>
                            {{ $item->question }}
                        </x-table.td>
                        <x-table.td class="text-right">
                            <x-form.action 
                                action="{{ route('question.destroy', $item) }}" 
                                verb="DELETE"  
                            >
                                {{ __('Delete') }}
                            </x-form.action>
                            <x-form.action 
                                action="{{ route('question.publish', $item) }}" 
                                verb="PUT"  
                            >
                                {{ __('Publish') }}
                            </x-form.action>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table.main>

        <hr class="my-4 border-gray-500 border-dashed">
        
        <x-typo.h3 class="mb-2">{{ __('Published') }}</x-typo.h3>

        <x-table.main>
            <x-table.thead>
                <tr>
                    <x-table.th>
                        Question
                    </x-table.th>
                    <x-table.th>
                        &nbsp;
                    </x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach($questions->where('draft', false) as $item)
                    <x-table.tr>
                        <x-table.td>
                            {{ $item->question }}
                        </x-table.td>
                        <x-table.td class="text-right">
                            <x-form.action 
                                action="{{ route('question.destroy', $item) }}" 
                                verb="DELETE"  
                            >
                                {{ __('Delete') }}
                            </x-form.action>
                            <x-form.action 
                                action="{{ route('question.unpublish', $item) }}" 
                                verb="PUT"  
                            >
                                {{ __('Unpublish') }}
                            </x-form.action>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table.main>
       
    </x-container>
    
</x-app-layout>
