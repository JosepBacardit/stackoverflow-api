<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StackOverflowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_questions_tagged()
    {
        $this->json('GET', '/api/questions/php')
            ->assertJsonStructure([
                'success', 'data'
            ]);
    }

    /** @test */
    public function test_get_questions_tagged_from()
    {
        $this->json('GET', '/api/questions/php/1629650400')
            ->assertJsonStructure([
                'success', 'data'
            ]);
    }

    /** @test */
    public function test_get_questions_tagged_from_to()
    {
        $this->json('GET', '/api/questions/php/1629650400/1629676800')
            ->assertJsonStructure([
                'success', 'data'
            ]);
    }
}
