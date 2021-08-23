<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StackOverflowAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_questions_tagged()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/questions/php');
        $response->assertOk();
    }

    /** @test */
    public function test_get_questions_tagged_from()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/questions/php/1629650400');
        $response->assertOk();
    }

    /** @test */
    public function test_get_questions_tagged_from_to()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/questions/php/1629650400/1629676800');
        $response->assertOk();
    }
}
