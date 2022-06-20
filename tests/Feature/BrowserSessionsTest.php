<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('log out of other browser sessions', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->delete('/user/other-browser-sessions', [
        'password' => 'password',
    ]);

    $response->assertSessionHasNoErrors();
});
