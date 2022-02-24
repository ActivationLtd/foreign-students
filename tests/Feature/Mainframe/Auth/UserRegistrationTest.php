<?php

namespace Tests\Feature\Mainframe\Auth;

use App\Group;
use App\Projects\DgmeStudents\Notifications\Auth\VerifyEmail;
use App\User;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

    }

    /**
     * Guest can see registration page
     *
     * @return void
     */
    public function test_see_registration_page()
    {

        $this->get('register')
            ->assertStatus(200)
            ->assertSee('User Registration')->assertSeeInOrder([
                'Email Address',
                'Password',
                'Confirm Password',
                'Register',
            ]);
    }

    /**
     * @return void
     */
    public function test_guest_can_register_to_default_user_group()
    {
        \Mail::fake();
        \Notification::fake();

        $groupId = Group::byName('user')->id;

        $firstName = $this->faker->firstName;
        $email = $this->faker->email;

        $this->followingRedirects()
            ->post('register', [
                'first_name' => $firstName,
                'last_name' => $this->faker->lastName,
                'email' => $email,
                'password' => $this->password,
                'password_confirmation' => $this->password,
                // 'group_ids' => [$groupId], // Note: If no group is specified then by default 'user' group will be selected
            ])
            ->assertStatus(200)
            ->assertSee('Verify your email and log in.');

        $user = User::where('email', $email)->first(); // Get this newly created user from database

        \Notification::assertSentTo([$user], VerifyEmail::class); // This is a mailable class

        // $this->seeEmailWasSent()
        //     ->seeEmailCountEquals(1)
        //     ->seeEmailTo($user->email, $this->emails[0])
        //     ->seeEmailSubjectContains('Verify Email Address');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email_verified_at' => null,
            'group_ids' => "[\"5\"]",
        ]);

        echo "User #{$user->id} : {$user->email} created";
    }

    public function test_unverified_user_can_login_but_see_verification_prompt()
    {
        sleep(2);
        $user = $this->newlyRegisteredUser(); // Get this newly created user from database

        $this->followingRedirects()
            ->post('login', [
                'email' => $user->email,
                'password' => $this->password,
            ])
            ->assertStatus(200)
            ->assertSee('Email verification required');
    }

    public function test_guest_cannot_see_resend_verification_code_page()
    {
        $this->withExceptionHandling();
        // Guest is redirected to login
        $this->get('email/verify')->assertRedirect('login');

    }

    public function test_unverified_user_can_resend_verification_code_link()
    {

        \Mail::fake();
        \Notification::fake();

        sleep(2);
        $user = $this->newlyRegisteredUser(); // Get this newly created user from database

        $this->be($user);

        $this->followingRedirects()
            ->post('email/resend')
            ->assertStatus(200)
            ->assertSee('Email verification required')// ->assertDontSee("<button type=\"submit\">Resend verification link</button>")
        ;
        // Note: In above I couldn't capture session('resent') which conditionally renders a
        //  Different message in the HTML.

        \Notification::assertSentTo([$user], VerifyEmail::class); // This is a mailable class

        // $this->seeEmailWasSent()
        //     ->seeEmailCountEquals(1)
        //     ->seeEmailTo($user->email, $this->emails[0])
        //     ->seeEmailSubjectContains('Verify Email Address');
    }

    public function test_verified_user_can_see_dashboard_upon_login()
    {
        $this->markTestSkipped('test has to be updated');

        $user = $this->newlyRegisteredUser();
        $user->update(['email_verified_at' => now()]); // Force verify
        $this->be($user);

        $this->followingRedirects()->get('email/verify')->assertSee('Dashboard');

    }

    public function test_verified_user_can_login_and_see_dashboard()
    {
        $this->markTestSkipped('test has to be updated');

        $user = $this->newlyRegisteredUser(); // Get this newly created user from database

        $this->followingRedirects()
            ->post('login', [
                'email' => $user->email,
                'password' => $this->password,
            ])
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    public function test_user_can_access_data_block_variable()
    {
        $this->markTestSkipped('test has to be updated');

        $user = $this->newlyRegisteredUser(); // Get this newly created user from database

        $this->be($user);
        $this->followingRedirects()
            ->get('/')
            ->assertStatus(200)
            ->assertViewHas('sampleData', [
                'books' => [
                    'purchased' => 10,
                    'read' => 7,
                ],
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    public function newlyRegisteredUser()
    {
        return $this->latestUser();
    }

}