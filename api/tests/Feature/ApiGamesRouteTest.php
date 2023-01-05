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
        $response = $this->get('/api/games?name=shirt&number=2&difficulty=1&theme=1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "game" => [
                    'id',
                    'name',
                    'score',
                    'date',
                    'time',
                ],
                "questions" =>[
                    "*"=>[
                        "answers" => [
                            "*"=> [
                                "id",
                                "is_correct",
                                "name"
                            ]
                        ],
                        "question" => [
                            "difficulty",
                            "id",
                            "name",
                            "theme_id"
                        ]
                    ]     
                ]
            ],
            "meta" => [
                "success",
                "message"
            ]
        ]);
    }

    public function test_the_application_returns_a_fail_response_for_game_page_when_missing_query()
    {
        $response = $this->get('/api/games?name=shirt&number=2&difficulty=1');
        $response->assertStatus(400);
    }

    public function test_the_application_response_for_game_page_at_the_game()
    {
        $response = $this->postJson('/api/games/31/end', [
            "name" => "lAAOUINE",
            'score' => '25',
            'date' => '1999-04-09',
            'time' => '10',
        ]);
        $response
            ->assertStatus(200);
    }
}
