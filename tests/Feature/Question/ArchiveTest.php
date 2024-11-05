<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertNotSoftDeleted, assertSoftDeleted, patch};

it('should be able to archive a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)->refresh()->deleted_at->not->toBeNull();

});

it('should assert that only the author can archive question', function () {
    $author = User::factory()->create();

    $anotherUser = User::factory()->create();

    $question = Question::factory()->for($author, 'createdBy')->create();

    actingAs($anotherUser);

    patch(route('question.archive', $question))
        ->assertForbidden();

    actingAs($author);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);
    ;
});

it('should be able to restore an archived question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true, 'deleted_at' => now()]);

    patch(route('question.restore', $question))->assertRedirect();

    assertNotSoftDeleted('questions', ['id' => $question->id]);

});
