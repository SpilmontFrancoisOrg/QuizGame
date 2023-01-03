<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Game;
use App\Models\Question;
use App\Models\Theme;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Theme::factory()->create();

        Question::factory()->create([
            'theme_id' => 1,
        ]);

        Answer::factory(4)->create([
            'question_id' => 1,
            'is_correct' => false,
        ]);

        Answer::where('id', 4)->update([
            'is_correct' => true,
        ]);

        Game::factory()->create();
    }
}
