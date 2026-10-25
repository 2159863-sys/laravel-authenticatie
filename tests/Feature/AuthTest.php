<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// week 5 - logging users out
test('a logged in user can log out', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('show.login'));
    $this->assertGuest();
});

test('the layout shows a logout form with csrf protection', function () {
    $response = $this->get(route('show.login'));

    $response->assertSee('action="' . route('logout') . '"', false);
    $response->assertSee('name="_token"', false);
});
