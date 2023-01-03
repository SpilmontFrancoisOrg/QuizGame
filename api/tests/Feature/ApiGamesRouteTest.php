<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiGamesRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_the_application_returns_a_successful_response_for_game_page()
    {
        $response = $this->get('/api/games?name=shirt');

        $response->assertStatus(200);
       
    }
    public function test_the_application_response_for_game_page_()
    {
        $response = $this->get('/api/games?name=shirt');

        $response->assertStatus(200);
       
    }
}
