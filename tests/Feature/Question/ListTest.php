<?php
// Test H12: Questions List
// Issue #12: https://github.com/mmonari/hey-professor/issues/12
// When writing tests:
// AAA : Arrange, Act, Assert

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all published questions', function () {
    // Arrange:: create a user and log in as that user
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);
    // create 5 published questions
    $questions = Question::factory(5)->create(['draft' => false]);

    // Act:: User visits the dashboard
    $response = get(route('dashboard'));

    // Assert: The questions are listed and user is redirected to dashboard
    $response->assertOk(); // 200 OK

    /** @var Question $item */
    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }

});

it('should paginate published questions', function () {

    $user = User::factory()->create();
    actingAs($user);

    $questions = Question::factory(20)->create(['draft' => false]);

    $response = get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof \Illuminate\Pagination\LengthAwarePaginator;
        });

});

it('should sort descending by the highest voted questions', function () {
    $user        = User::factory()->create();
    $anotherUser = User::factory()->create();

    $questions = Question::factory(5)->create(['draft' => false]);

    $mostLikedQuestion   = Question::inRandomOrder()->first();
    $mostUnlikedQuestion = Question::inRandomOrder()->where('id', '<>', $mostLikedQuestion->id)->first();

    $user->likes($mostLikedQuestion);

    $anotherUser->dislikes($mostUnlikedQuestion);

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) use ($mostLikedQuestion, $mostUnlikedQuestion) {

            expect($questions)
                ->first()->id->toBe($mostLikedQuestion->id)
                ->and($questions)
                ->last()->id->toBe($mostUnlikedQuestion->id);

            return true;
        });

});
