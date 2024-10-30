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
    // create 5 questions
    $question = Question::factory()->create(['draft' => true]);

    // Act:: User visits the dashboard
    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();
    expect($question->draft)->toBeFalse();

});
