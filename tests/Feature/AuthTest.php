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
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ninjas.index'));

    $response->assertSee('action="' . route('logout') . '"', false);
    $response->assertSee('name="_token"', false);
});

// week 6 - logging users in
test('a user can log in with correct credentials', function () {
    $user = User::factory()->create(['password' => 'password123']);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('ninjas.index'));
    $this->assertAuthenticatedAs($user);
});

test('a user cannot log in with a wrong password', function () {
    $user = User::factory()->create(['password' => 'password123']);

    $response = $this->from(route('show.login'))->post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect(route('show.login'));
    $response->assertSessionHasErrors('credentials');
    $this->assertGuest();
});

test('login requires a valid email and a password', function () {
    $response = $this->post(route('login'), [
        'email' => 'not-an-email',
        'password' => '',
    ]);

    $response->assertSessionHasErrors(['email', 'password']);
    $this->assertGuest();
});

test('login errors are shown on the login page', function () {
    $this->followingRedirects()
        ->from(route('show.login'))
        ->post(route('login'), ['email' => 'nobody@example.com', 'password' => 'secret123'])
        ->assertSee('Sorry, incorrect credentials');
});

// week 7 - current user
test('a logged in user sees their name and the logout button', function () {
    $user = User::factory()->create(['name' => 'Shaun Ninja']);

    $response = $this->actingAs($user)->get(route('ninjas.index'));

    $response->assertOk();
    $response->assertSee('Hi there, Shaun Ninja');
    $response->assertSee('Logout');
    $response->assertSee('Create New Ninja');
    $response->assertDontSee('href="' . route('show.login') . '"', false);
    $response->assertDontSee('href="' . route('show.register') . '"', false);
});

test('a guest sees login and register links without errors', function () {
    $response = $this->get(route('show.login'));

    $response->assertOk();
    $response->assertSee('href="' . route('show.login') . '"', false);
    $response->assertSee('href="' . route('show.register') . '"', false);
    $response->assertDontSee('Hi there');
    $response->assertDontSee('action="' . route('logout') . '"', false);
});
