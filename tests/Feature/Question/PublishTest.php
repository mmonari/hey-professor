<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publish a draft question', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();
    expect($question->draft)->toBeFalse();

});

it('should assert that only the author can publish draft question', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $author */
    $author = User::factory()->create();

    /** @var User $anotherUser */
    $anotherUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $author->id]);

    actingAs($anotherUser);

    put(route('question.publish', $question))
        ->assertForbidden();

    actingAs($author);

    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();
    expect($question->draft)->toBeFalse();
});
