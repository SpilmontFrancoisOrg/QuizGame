<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $themes = Theme::all();

        foreach ($themes as $theme) {
            $theme->image = Http::get('https://api.unsplash.com/search/photos/?client_id=LqDwnvbRRQPNg17mZdK4b-ga63HEeq-Nx2EDfH5ha48&query=' . $theme->name)['results'][0]['urls']['thumb'];
        }

        return $this->success($themes);
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

        return $this->resourceCreated($theme);
    }
}
