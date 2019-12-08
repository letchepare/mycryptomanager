<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // make the sqlite in memory DataBase refreshing on classLoading
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use alt + 255 to get a non breakable space for test naming
    public function test user can view a login form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test user cannot view login page when authenticated(){
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('login');

        $response->assertRedirect('/home');
    }

    public function test user can connect with right credentials(){

        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'test-login'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test user cannot connect with bad credentials(){

        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'test-loginn'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'test-login',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test remember me functionality(){
        $user = factory(User::class)->create([
            'id' => random int(0,100),
            'password' => bcrypt($password = 'test-login')
        ]);


        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect('/home');
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    public function test user receives an email with a password reset link(){

        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        $token = DB::table('password resets')->first();
        $this->assertNotNull($token);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }
}
