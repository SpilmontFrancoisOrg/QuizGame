<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiThemesRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function test_the_post_theme_route()
    {
        $response = $this->postJson('/api/themes', ['name' => 'cuisine']);
 
        $response
            ->assertStatus(200);

    } 
    public function test_the_post_theme_route_not_working_with_int()
    {
        $response = $this->postJson('/api/themes', ['name' => 12]);
 
        $response
            ->assertStatus(422);

    } 
    public function test_the_post_theme_route_not_working_with_no_value()
    {
        $response = $this->postJson('/api/themes', ['name' => ""]);
 
        $response
            ->assertStatus(422);

    } 
}
