<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $number = $request->input('number');
        $difficulty = $request->input('difficulty');
        $questions = Question::inRandomOrder()->where('difficulty', $difficulty)->take($number)->get();

        $answers = [];
        foreach ($questions as $question)
            $answers[] = $question->answers()->get();

        $data = [];
        foreach ($questions as $key => $question)
            $data[] = [
                'question' => $question,
                'answers' => $answers[$key]
            ];

        $name = $request->input('name');

        $game = new Game();
        $game->name = $name;
        $game->date = now()->toDateString();
        $game->save();

        $data = [
            'game' => $game,
            'questions' => $data
        ];

        return $this->success($data);
    }

    public function leaderboard(Request $request): JsonResponse
    {
        $games = Game::orderBy('score', 'desc')->get();

        return $this->success($games);
    }
}