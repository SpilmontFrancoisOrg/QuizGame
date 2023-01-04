<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiQuestionsRouteTest extends TestCase
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
    public function test_the_post_questions_route()
    {
        $response = $this->postJson('/api/questions', [
            "name"=>"Who is in the kitchen ?",
            'difficulty' => '3',
            'theme_id' => '2',
            "answers"=>[["name"=> "me, I eat lol", "is_correct"=>true], ["name"=> "me, I eat lol", "is_correct"=>true]]
        ]);
        
        $response
            ->assertStatus(200);

    } 
}