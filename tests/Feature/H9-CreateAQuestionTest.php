<?php
// Test H9: Create a question
// Issue #9: https://github.com/mmonari/hey-professor/issues/9
// When writing tests: 
// AAA : Arrange, Act, Assert

use App\Models\User;
use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, postJson};

// Here we list the requirements from the github issue
// issue #9


it('should be able to create a question that is bigger than 255 characters', function () {
    // Arrange:: create a user and log in as that user
    $user = User::factory()->create();
    actingAs($user);

    // Act:: User submits a question to create it.
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 256) . '?' ,
    ]);

    // Assert: The question is created and user is redirected to dashboard
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [ 'question' => str_repeat('*', 256) . '?' ]);

});

it('should check if question ends with a question mark', function () {
    return true;
})->todo();

it('should have at least 3 words', function () {
    return true;
})->todo();
