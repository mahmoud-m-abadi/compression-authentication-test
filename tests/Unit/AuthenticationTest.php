<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginWithGoogleService()
    {
        Socialite::shouldReceive('driver')
            ->with('google')
            ->once();

        $this->get('auth/google/redirect')->isRedirection();
    }

    public function testLoginCallbackWithGoogleService()
    {
        \Mockery::getConfiguration()->allowMockingNonExistentMethods(false);

        $abstractUser = \Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn($name = $this->faker->name())
            ->shouldReceive('getEmail')
            ->andReturn($email = $this->faker->name() . '@gmail.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = \Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $this->get('auth/google/callback')
            ->assertSee($email);
    }
}
