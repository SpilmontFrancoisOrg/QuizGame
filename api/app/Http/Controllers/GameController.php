<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\GameResource;

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

        //return response()->json($data);
        return response()->json(new GameResource($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
