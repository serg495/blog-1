<?php

namespace Tests\Feature\Auth;

use App\Notifications\Auth\VerifyEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EmailVerificetionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_sends_verification_email_after_user_created()
    {
        Notification::fake();

        $this->registerUser($this->makeUser());

        $user = User::first();

        Notification::assertSentTo([$user], VerifyEmail::class);
    }

    /** @test */
    public function it_updates_email_verified_at()
    {
        $user = tap($this->makeUser())->save();

        $this->get($this->getVerificationUrl($user));

        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function getVerificationUrl(User $user): string
    {
        return url()->temporarySignedRoute(
            'email.verify', now()->addMinutes(60), ['user' => $user->id]
        );
    }

    public function registerUser(User $user): TestResponse
    {
        $data = $user->getAttributes();
        $data['password_confirmation'] = $data['password'];

        return $this->post('register', $data);
    }

    public function makeUser(array $attributes = []): User
    {
        return factory(User::class)->make($attributes);
    }
}
