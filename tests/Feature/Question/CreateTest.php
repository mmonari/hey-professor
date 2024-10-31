<?php
// Test H9: Create a question
// Issue #9: https://github.com/mmonari/hey-professor/issues/9
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

// Here we list the requirements from the github issue
// issue #9

it('should let only authenticated users create a question', function () {

    post(route('question.store'), [
        'question' => str_repeat('*', 256) . '?' ,
    ])->assertRedirect(route('login'));

});

it('should be able to create a question that is bigger than 255 characters', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    // Act:: User submits a question to create it.
    $request = post(route('question.store'), [
        'question'   => str_repeat('*', 256) . '?' ,
        'created_by' => $user->id,
    ]);

    // Assert: The question is created and user is redirected to dashboard
    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 256) . '?']);

});

it('should check if question ends with a question mark', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    // Act:: User submits a question to create it.
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10) ,
    ]);

    // Assert:
    $request->assertSessionHasErrors([
        'question' => 'The question must end with a question mark.',
    ]);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    // Act:: User submits a question to create it.
    // shot question under 10 characters
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?' ,
    ]);

    // Assert:
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);

});

it('should be created as a draft at first', function () {

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 200) . '?' ,
    ]);

    // Assert:
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 200) . '?',
        'draft'    => true,
    ]);

});
