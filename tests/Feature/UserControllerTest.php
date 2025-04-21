<?php

use App\Models\User;

use function Pest\Laravel\getJson;

it('return all users', function () {
    User::factory()->count(3)->create();

    getJson(route('users.index'))
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});
