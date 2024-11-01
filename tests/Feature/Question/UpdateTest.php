<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to update a question', function () {

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    put(route('question.update', $question), ['question' => 'testing update question really?'])->assertRedirect();

    $question->refresh();

    expect($question->question)->toBe('testing update question really?');

});

it('should be able to update only own draft questions', function () {
    /** @var User $user */
    $user = User::factory()->create();

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    /** @var User $anotherUser */
    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    put(route('question.update', $question))->assertForbidden();

});
