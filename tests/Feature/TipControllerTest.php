<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\ProcessAnalytic;
use App\Tip;
use Carbon\Carbon;
use GitDown\Facades\GitDown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

final class TipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index(): void
    {
        // Arrange
        Tip::factory()->create([
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

    /**
     * @test
     */
    public function show(): void
    {
        // Arrange
        Bus::fake();
        $tip = Tip::factory()->create([
            'title' => 'Eloquent vs Collection Count',
            'slug' => 'eloquent-vs-collection-count',
            'body' => 'Use $model->relationship()->count() instead of $model->relationship->count()',
            'published_at' => Carbon::yesterday(),
        ]);
        GitDown::shouldReceive('parseAndCache')->andReturn($tip->body);
        GitDown::shouldReceive('styles')->andReturn(null);

        // Act
        $response = $this->get('/tip/eloquent-vs-collection-count');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('Eloquent vs Collection Count');
        $response->assertSee($tip->parsed_body);
        Bus::assertDispatched(ProcessAnalytic::class);
    }
}
