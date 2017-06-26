<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
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
