<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to give it a Like', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    $response = post(route('question.like', $question->id))->assertRedirect();

    $response->assertRedirect();

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
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    //assert
    expect($user->votes()->where('question_id', $question->id)
        ->count())->toBe(1);

});

it('should be able to give it a Dislike', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    $response = post(route('question.dislike', $question->id))->assertRedirect();

    $response->assertRedirect();

    // Assert: The question is listed and user is redirected to dashboard
    assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'likes'       => 0,
        'dislikes'    => 1,
    ]);

});

it('should NOT be able to give it a second or more Dislikes to the same question', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    post(route('question.dislike', $question));
    post(route('question.dislike', $question));
    post(route('question.dislike', $question));

    //assert
    expect($user->votes()->where('question_id', $question->id)
        ->count())->toBe(1);
});

it('should NOT have both likes and dislikes on same question ', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create a question
    $question = Question::factory()->create();

    // Act:: Post a like to the question
    post(route('question.like', $question));
    post(route('question.dislike', $question));

    //assert
    expect($user->votes()
        ->where('question_id', $question->id)
        ->where('likes', 1)
        ->where('dislikes', 1)
        ->count())->toBe(0);
});
