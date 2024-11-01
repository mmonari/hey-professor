<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to open a question to edit', function () {
    // Arrange:: create a user and log in as that user

    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    /** @var Question $question */
    $question = Question::factory()->for($user, 'createdBy')->create();

    get(route('question.edit', $question))->assertOk();

});
