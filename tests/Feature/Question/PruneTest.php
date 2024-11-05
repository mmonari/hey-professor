<?php

use App\Models\Question;

use function Pest\Laravel\{artisan, assertDatabaseMissing};

it('should prune month old archived / soft deleted questions', function () {

    $question = Question::factory()->create(['deleted_at' => now()->subMonth()->subDay()]);

    artisan('model:prune');

    assertDatabaseMissing('questions', ['id' => $question->id]);

});
