<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ThemeResource;
use App\Models\Question;
use Illuminate\Support\Facades\Http;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $allThemes = Theme::all();

        $themes = [];
        foreach ($allThemes as $theme)
            if (Question::where('theme_id', $theme->id)->count() > 0)
                $themes[] = $theme;

        foreach ($themes as $theme)
            $theme->image = Http::get('https://api.unsplash.com/search/photos/?client_id=' . env('CLIENT_ID') . '&query=' . $theme->name)['results'][0]['urls']['thumb'];

        return $this->success(ThemeResource::collection($themes));
    }

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
        ]);

        $theme = Theme::create($input);

        return $this->resourceCreated(new ThemeResource($theme));
    }
}
