<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FilmRequest;


class FilmController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => Film::query()->get(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    
    public function create(FilmRequest $request): JsonResponse
    {
        try {
            $film = new Film();
            $film->name = $request->name;
            $film->description = $request->description;
            $film->save();

            return response()->json([
                'status' => 'success',
                'data' => $film
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function update(FilmRequest $request): JsonResponse
    {
        try {
            $film = Film::find($request->id);
            $film->name = $request->name;
            $film->description = $request->description;
            $film->save();

            return response()->json([
                'status' => 'success',
                'data' => $film
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }


    public function delete(Request $request): JsonResponse
    {
        try {
            Film::destroy($request->id);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
