<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->validate([
            'name' => 'string|required',
            'difficulty' => 'integer|in:1,2,3,4,5|required',
            'theme_id' => 'exists:themes,id|required',
            'answers' => 'array|required',
            'answers.*.name' => 'string|required',
            'answers.*.is_correct' => 'boolean|required'
        ]);

        $question = Question::create($input);

        foreach ($input['answers'] as $answer)
            $question->answers()->create($answer);

        return response()->json($question);
    }
}
