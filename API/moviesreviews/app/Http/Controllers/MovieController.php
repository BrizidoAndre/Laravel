<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\Artist;
use App\Models\Credit;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function movies(Request $request)
    {

        $page = !is_null($request->query('page')) ? $request->query('page') : 1;
        $pageSize = !is_null($request->query('pageSize')) ? $request->query('pageSize') : 4;
        $sortDir = !is_null($request->query('sortDir')) ? $request->query('sortDir') : 'desc';
        $sortBy = !is_null($request->query('sortBy')) ? $request->query('sortBy') : 'releaseDate';

        $queryArtist = $queryGenre = "movie.id != ''";

        if (!is_null($request->artistId)) {
            if (is_null(Artist::find($request->artistId))) {
                return response()->json(['message' => 'Invalid artist id'], 400);
            }

            $queryArtist = "credit.artistId = $request->artistId";
        }

        if (!is_null($request->genreId)) {
            if (is_null(Genre::find($request->genreId))) {
                return response()->json(['message' => 'Invalid genre movie id'], 400);
            }

            $queryGenre = "movie.genreId = $request->genreId";
        }

        $movies = Movie::selectRaw('
            movie.id,
            movie.title, 
            durationMinutes, 
            releaseDate, 
            AVG(review.stars) as score, 
            COUNT(review.id) as reviewsCount, 
            posterUrl
        ')
            ->join('review', 'movie.id', '=', 'review.movieId')
            ->join('credit', 'movie.id', '=', 'credit.movieId')
            ->join('genre', 'movie.genreId', '=', 'genre.id')
            ->whereRaw($queryArtist)
            ->whereRaw($queryGenre)
            ->groupBy('movie.title')
            ->orderBy($sortBy, $sortDir)
            ->paginate($pageSize, ['*'], '', $page);

        $movies->getCollection()->transform(function ($movie) {

            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'duration' => Movie::formatDuration($movie),
                'releaseDate' => $movie->releaseDate,
                'score' => Movie::getScore($movie),
                'reviewsCount' => Review::where('movieId', $movie->id)->count(),
                'posterUrl' => url('/public/storage/media') . '/' . $movie->posterUrl . '.jpg',
                'singlePageUrl' => url()->current() . '/' . $movie->id
            ];
        });

        return response()->json($movies->toArray()['data']);
    }

    public function view($id)
    {
        $movie = Movie::find($id);

        if (is_null($movie)) {
            return response()->json(['message' => 'Invalid movie id'], 404);
        }

        $credits = Credit::where('movieId', $id)->paginate();

        $credits->getCollection()->transform(function ($credit) {

            $artist = Artist::find($credit->artistId);

            return [
                'artistId' => $artist->id,
                'name' => $artist->name,
                'role' => Role::find($credit->roleId)->title,
                'photoUrl' => str_replace('movies/' . $credit->movieId, 'media', url()->current()) . '/' . $artist->photoUrl,
                'singlePageUrl' => str_replace('movies/' . $credit->movieId, 'artists', url()->current()) . '/' . $artist->id
            ];
        });

        return [
            'title' => $movie->title,
            'synopsis' => $movie->synopsis,
            'duration' => Movie::formatDuration($movie),
            'releaseDate' => $movie->releaseDate,
            'score' => Movie::getScore($movie),
            'reviewsCount' => Review::where('movieId', $movie->id)->count(),
            'trailerUrl' =>  url('/public/storage/media') . '/' . $movie->trailerUrl . '.mp4',
            'credits' => $credits->toArray()['data']
        ];
    }
}
