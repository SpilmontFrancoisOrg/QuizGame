<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerResource;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\GameResource;
use App\Http\Resources\QuestionResource;

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
        $questions = Question::inRandomOrder()
            ->where(['difficulty' => $request->input('difficulty'), 'theme_id' => $request->input('theme')])
            ->take($request->input('number'))
            ->get();

        $data = [];
        foreach ($questions as $question) {
            $data[] = [
                'question' => new QuestionResource($question),
                'answers' => AnswerResource::collection($question->answers()->get())
            ];
        }

        $game = new Game();
        $game->name = $request->input('name');
        $game->date = now()->toDateString();
        $game->save();

        $data = [
            'game' => new GameResource($game),
            'questions' => $data
        ];

        return $this->success($data);
    }

    public function leaderboard(): JsonResponse
    {
        $games = Game::orderBy('score', 'desc')->get();

        return $this->success(GameResource::collection($games));
    }

    public function endGame(Request $request, Game $game): JsonResponse
    {
        $game->score = $request->input('score');
        $game->time = $request->input('time');
        $game->save();

        return $this->success(new GameResource($game));
    }
}
