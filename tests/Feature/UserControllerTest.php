<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, getJson};

it('return all users', function () {
    $user = User::factory()->create();
    actingAs($user);

    User::factory()->count(3)->create();

    getJson(route('users.index'))
        ->assertStatus(200)
        ->assertJsonCount(4, 'data');
});
