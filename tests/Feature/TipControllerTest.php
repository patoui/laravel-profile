<?php

namespace Tests\Feature;

use App\Tip;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TipControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Arrange
        factory(Tip::class)->create([
            'title' => 'Eloquent vs Collection Count',
            'slug' => 'eloquent-vs-collection-count',
            'body' => 'Use $model->relationship()->count() instead of $model->relationship->count()',
            'published_at' => Carbon::yesterday(),
        ]);

        // Act
        $response = $this->get('/tip');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('Eloquent vs Collection Count');
    }

    public function testShow()
    {
        // Arrange
        $tip = factory(Tip::class)->create([
            'title' => 'Eloquent vs Collection Count',
            'slug' => 'eloquent-vs-collection-count',
            'body' => 'Use $model->relationship()->count() instead of $model->relationship->count()',
            'published_at' => Carbon::yesterday(),
        ]);

        // Act
        $response = $this->get('/tip/eloquent-vs-collection-count');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('Eloquent vs Collection Count');
        $response->assertSee($tip->parsed_body);
    }
}
