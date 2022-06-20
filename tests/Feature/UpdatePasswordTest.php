<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('can update user passwords', function () {
    $this->actingAs($user = User::factory()->create());

    $this->put('/user/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
});

it('requires the current password to be correct', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors();

    $this->assertTrue(Hash::check('password', $user->fresh()->password));
});

it('requires new passwords to match', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();

    $this->assertTrue(Hash::check('password', $user->fresh()->password));
});
