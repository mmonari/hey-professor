<?php
use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to search questions', function () {

    $user = User::factory()->create();
    actingAs($user);

    $randomQuestion = Question::factory()->create([
        'question' => 'Is this not another question, is it?',
        'draft'    => false,
    ]);

    $findMeQuestion = Question::factory()->create([
        'question' => 'This is really going to find me? Really?',
        'draft'    => false]);

    $response = get(route('dashboard', ['search' => 'find me']));
    $response->assertOk();
    $response->assertSee($findMeQuestion->question);
    $response->assertDontSee($randomQuestion->question);
});
