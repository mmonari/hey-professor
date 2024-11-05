<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing, assertSoftDeleted, delete, put};

it('should be able to archive a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    put(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)->refresh()->deleted_at->not->toBeNull();

});

it('should assert that only the author can archive question', function () {
    // $author = User::factory()->create();

    // $anotherUser = User::factory()->create();

    // $question = Question::factory()->for($author, 'createdBy')->create();

    // actingAs($anotherUser);

    // delete(route('question.destroy', $question))
    //     ->assertForbidden();

    // actingAs($author);

    // delete(route('question.destroy', $question))
    //     ->assertRedirect();

    // assertDatabaseMissing('questions', ['id' => $question->id]);
})->todo();
