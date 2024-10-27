<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all questions', function () {
    // Arrange:: create a user and log in as that user
    $user = User::factory()->create();
    actingAs($user);
    // create 5 questions
    $questions = Question::factory(5)->create();

    // Act:: User visits the dashboard
    $response = get(route('dashboard'));

    // Assert: The questions are listed and user is redirected to dashboard
    $response->assertOk(); // 200 OK

    /** @var Question $item */
    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }

});

it('should be able to give it a Like', function () {
})->todo();

it('should be able to give it a Dislike', function () {
})->todo();

it('should show a like count on each question', function () {
})->todo();
