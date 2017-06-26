<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Testing login.
     *
     * @group acceptance
     * @return void
     */
    public function testHome()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertPathIs('/')
                ->assertSee('Patrique Ouimet');
        });
    }
}
