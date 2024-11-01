<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get, put};

it('should be able to return a view with question to edit', function () {
    // Arrange:: create a user and log in as that user

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create();

    get(route('question.edit', $question))->assertViewis('question.edit');

});

it('should be able to only update draft questions', function () {

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);

    put(route('question.update', $question))->assertForbidden();

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

})->todo();
