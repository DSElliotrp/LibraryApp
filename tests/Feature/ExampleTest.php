<?php

use App\Models\User;

it('returns a successful response', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/');

    $response->assertStatus(200);
});
