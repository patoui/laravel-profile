<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactMeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $this->visit('/')
             ->type('Patrique Ouimet', 'name')
             ->type('patrique.ouimet@gmail.com', 'email')
             ->type('9059220633', 'phone')
             ->type('Hello World!', 'message')
             ->type('Patrique Ouimet', 'name')
             ->press('Send')
             ->seePageIs('/');
    }
}
