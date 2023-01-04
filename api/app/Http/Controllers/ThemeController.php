<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\ThemeResource;

class ThemeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $input = $request->validate([
            'name' => 'string|required',
        ]);

        $theme = Theme::create($input);

        return response()->json( new ThemeResource($theme));
    }
}
