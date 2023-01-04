<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsRequest;
use App\Models\Films;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->name){
            $films = Films::paginate(5);
            return json_encode($films, 200);
        }
        $films = Films::whereName($request->name)->paginate(5);
        return json_encode($films, 200);
    }

    public function store(FilmsRequest $request)
    {
        $film = Films::create($request->all());
        return json_encode($film, 201);
    }

    public function show(int $film)
    {
        $film = Films::find($film);
        if (is_null($film)) {
            return json_encode(['error' => 'Not found'], 404);
        }
        return json_encode($film, 200);
    }

    public function update(FilmsRequest $request, Films $film)
    {
        $film->update($request->all());
        return json_encode($film, 200);
    }

    public function destroy(Films $film)
    {
        $film->delete();
        return json_encode(null, 204);
    }
}
