<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing, delete};

it('should be able to destroy a question', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    delete(route('question.destroy', $question))
        ->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('should assert that only the author can destroy question', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $author */
    $author = User::factory()->create();

    /** @var User $anotherUser */
    $anotherUser = User::factory()->create();

    $question = Question::factory()->for($author, 'createdBy')->create();

    actingAs($anotherUser);

    delete(route('question.destroy', $question))
        ->assertForbidden();

    actingAs($author);

    delete(route('question.destroy', $question))
        ->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);
});
