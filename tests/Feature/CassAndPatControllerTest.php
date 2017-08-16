<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CassAndPatControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShow2016()
    {
        // Act
        $response = $this->get('cass-and-pat/2016');

        // Assert
        $response->assertStatus(200);
    }
}
