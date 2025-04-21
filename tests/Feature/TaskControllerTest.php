<?php

use App\Models\{Task, User};

use function Pest\Laravel\{actingAs, getJson};

it('return all tasks', function () {
    Task::factory()->count(3)->create();

    getJson(route('tasks.index'))
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('return a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    actingAs($user);

    getJson(route('tasks.show', $task->id))
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $task->id,
            ],
        ]);
});

it('forbids access to a task owned by another user', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user1->id]);

    actingAs($user2);

    getJson(route('tasks.show', $task->id))
        ->assertForbidden();
});
