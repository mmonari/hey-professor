<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to return a view with question to edit', function () {
    // Arrange:: create a user and log in as that user

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    get(route('question.edit', $question))->assertViewis('question.edit');

});

it('should be able to edit own draft questions', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var User $anotherUser */
    $anotherUser = User::factory()->create();

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($anotherUser);
    get(route('question.edit', $question))->assertForbidden();

    actingAs($user);
    get(route('question.edit', $question))->assertViewis('question.edit');

});
