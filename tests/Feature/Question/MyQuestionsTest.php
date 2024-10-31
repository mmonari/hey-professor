<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list questions created by user and not from others', function () {

    /** @var User $otherUser */
    $otherUser      = User::factory()->create();
    $otherQuestions = Question::factory()->for($otherUser, 'createdBy')->count(5)->create();

    /** @var User $user */
    $user          = User::factory()->create();
    $userQuestions = Question::factory()->for($user, 'createdBy')->count(5)->create();

    actingAs($user);

    $response = get(route('question.index'));

    /** @var Question $item */
    foreach ($otherQuestions as $item) {
        $response->assertDontSee($item->question);
    }

    /** @var Question $item */
    foreach ($userQuestions as $item) {
        $response->assertSee($item->question);
    }

});
