<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

it('should be able to update a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    put(route('question.update', $question), ['question' => 'testing update question really?'])->assertRedirect();

    $question->refresh();

    expect($question->question)->toBe('testing update question really?');

});

it('should be able to update only own draft questions', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    put(route('question.update', $question))->assertForbidden();

});

// Now lets assert orignal tests from create question is present while updating

it('should let only authenticated users create a question', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    put(route('question.update', $question), [
        'question' => str_repeat('*', 256) . '?' ,

    ])->assertRedirect(route('login'));

});

it('should be able to update a question that is bigger than 255 characters', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 256) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseHas('questions', ['question' => str_repeat('*', 256) . '?']);

});

it('should check if question ends with a question mark', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors(['question']);

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);

});

it('should have at least 10 characters', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});
