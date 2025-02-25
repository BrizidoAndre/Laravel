<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Credit;
use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function artists(Request $request) {
        $page = !is_null($request->query('page')) ? $request->query('page') : 1;
        $pageSize = !is_null($request->query('pageSize')) ? $request->query('pageSize') : 10;
        $sortDir = !is_null($request->query('sortDir')) ? $request->query('sortDir') : 'asc';
        $sortBy = !is_null($request->query('sortBy')) ? $request->query('sortBy') : 'name';

        $artists = Artist::selectRaw('
            artist.id,
            name,
            photoUrl,
            COUNT(credit.id) as moviesCount
        ')
            ->fromRaw('artist, credit')
            ->whereRaw('artist.id = credit.artistId')
            ->groupBy('artist.id')
            ->orderBy($sortBy, $sortDir)
            ->paginate($pageSize, ['*'], '', $page);

        $artists->getCollection()->transform(function ($artist) {
            
            return [
                'id' => $artist->id,
                'name' => $artist->name,
                'photoUrl' => str_replace('artists', 'media/'.$artist->photoUrl, url()->current()),
                'singlePage' => str_replace('artists', 'artists/'.$artist->id, url()->current()),
                'moviesCount' => Credit::where('artistId', $artist->id)->count(),
            ];
        });

        return response()->json($artists->toArray()['data']);
    }

    public function view($id) {
        $artist = Artist::find($id);

        if (is_null($artist)) {
            return response()->json(['message' => 'Invalid artist id'], 404);
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
            ->fromRaw('movie, credit, review')
            ->whereRaw('movie.id = review.movieId')
            ->whereRaw('credit.movieId = movie.id')
            ->whereRaw('credit.artistId = '.$id)
            ->groupBy('movie.title')
            ->paginate();

        $movies->getCollection()->transform(function ($movie) {

            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'duration' => Movie::formatDuration($movie),
                'releaseDate' => $movie->releaseDate,
                'score' => Movie::getScore($movie),
                'reviewsCount' => Review::where('movieId', $movie->id)->count(),
                'posterUrl' => url('/api/v1/media') . '/' . $movie->posterUrl,
                'singlePageUrl' => url('/api/v1/movie') . '/' . $movie->id
            ];
        });
    
        return [
            'name' => $artist->name,
            'birthday' => $artist->birthday,
            'biography' => $artist->biography,
            'photoUrl' => str_replace('artists/'.$id, 'media/'.$artist->photoUrl, url()->current()),
            'movies' => $movies->toArray()['data']
        ];
    }
}
