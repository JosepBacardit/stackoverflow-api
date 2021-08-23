<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_user_can_be_register()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name;
        $email = $faker->email;

        $response = $this->post('/api/register',[
            'name' => $name,
            'email' => $email,
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, User::all());

        $user = User::first();
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
    }

    /** @test */
    public function test_a_user_can_be_login()
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('123456')
        ]);

        $response = $this->post('/api/login',[
            'email' => $user->email,
            'password' => '123456'
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function test_a_user_can_be_logout()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->post('/api/logout');
        $response->assertStatus(200);
    }
}
