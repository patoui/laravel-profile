<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Testing login.
     *
     * @group acceptance
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/dashboard');
        });
    }
}
