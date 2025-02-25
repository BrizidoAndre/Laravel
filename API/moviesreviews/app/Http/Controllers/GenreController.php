<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function genres(Request $request) {
        $page = !is_null($request->query('page')) ? $request->query('page') : 1;
        $pageSize = !is_null($request->query('pageSize')) ? $request->query('pageSize') : 10;
        $sortDir = !is_null($request->query('sortDir')) ? $request->query('sortDir') : 'desc';
        $sortBy = !is_null($request->query('sortBy')) ? $request->query('sortBy') : 'title';

        $genres = Genre::selectRaw('genre.id, COUNT(movie.id) as moviesCount, genre.title')
            ->fromRaw('genre, movie')
            ->whereRaw('genre.id = movie.genreId')
            ->groupBy('genre.id')
            ->orderBy($sortBy, $sortDir)
            ->paginate($pageSize, ['*'], '', $page);
        
        $genres->getCollection()->transform(function ($genre) {
            return [
                'id' => $genre->id,
                'title' => $genre->title,
                'moviesCount' => Movie::where('genreId', $genre->id)->count()
            ];
        });

        return response()->json($genres->toArray()['data']);
    }
}
