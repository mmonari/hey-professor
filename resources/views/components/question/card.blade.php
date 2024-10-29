@props(['question'])
<div class="p-2 rounded-md border border-gray-300 shadow dark:border-gray-600 dark:text-gray-400 shadow-blue-400/60">
    <div class="flex justify-between items-center">
        <span>{{ $question->question }}</span>
        <div class="flex gap-2">
            <div class="flex gap-1">
                <x-form.main action="{{ route('question.like', $question) }}" >
                    <button type="submit" class="text-green-500/50 size-6 hover:text-green-500">
                        <x-heroicon.thumb-up />
                    </button>
                </x-form.main>
                <span>{{ ($question->votes_sum_likes ?? 0) }}</span>
            </div>
            <div class="flex gap-1">
                <x-form.main action="{{ route('question.dislike', $question) }}" >
                    <button type="submit" class="text-red-500/50 size-6 hover:text-red-500">
                        <x-heroicon.thumb-down />
                    </button>
                </x-form.main>    
                <span>{{ ($question->votes_sum_dislikes ?? 0) }}</span>
            </div>
        </div>
    </div>
</div>