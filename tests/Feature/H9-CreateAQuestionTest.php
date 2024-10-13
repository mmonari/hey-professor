<?php
// Test H9: Create a question
// Issue #9: https://github.com/mmonari/hey-professor/issues/9
// AAA : Arrange, Act, Assert

use App\Models\User;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, postJson};

it('should be able to create a question that is bigger than 255 characters', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);
    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 256) . '?' ,
    ]);
    // Assert
    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    //assertDatabaseHas('questions', [ 'question' => str_repeat('*', 256) . '?' ]);

});

it('should check if question ends with a question mark', function () {
    return true;
});

it('should have at least 3 words', function () {
    return true;
});
