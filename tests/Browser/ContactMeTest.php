<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class ContactMeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Testing login.
     *
     * @group acceptance
     * @return void
     */
    public function testContactMe()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('name', 'Patrique Ouimet')
                ->type('email', 'patrique.ouimet@gmail.com')
                ->type('phone', '9059220633')
                ->type('message', 'Hello World!')
                ->press('Send')
                ->assertPathIs('/')
                ->assertSee('Thank you! I\'ll be in touch!');
        });
    }
}
