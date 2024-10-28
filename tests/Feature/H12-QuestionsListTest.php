<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, get, post};

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
    // Arrange:: create a user and log in as that user
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    $response = post(route('question.like', $question->id))->assertRedirect();

    $response->assertRedirect(route('dashboard'));

    // Assert: The question is listed and user is redirected to dashboard
    assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'likes'       => 1,
        'dislikes'    => 0,
    ]);

});

it('should NOT be able to give it a second  or more Likes to the same question', function () {
    // Arrange:: create a user and log in as that user
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    post(route('question.like', $question->id));
    post(route('question.like', $question->id));
    post(route('question.like', $question->id));

    //assert
    expect($user->votes()->where('question_id', $question->id)
        ->count())->toBe(1);

});

it('should be able to give it a Dislike', function () {
})->todo();

it('should show a like count on each question', function () {
})->todo();
