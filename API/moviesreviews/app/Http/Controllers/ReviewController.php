<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\Movie;
use App\Models\Review;
use App\Models\ReviewEvaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function create(Request $request, $movieId)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'stars' => 'required|integer|min:1|max:10',
            ],
            [
                'required' => 'O campo :attribute é obrigatorio',
                'min' => 'O campo stars deve ser um valor entre 1 e 10',
                'max' => 'O campo stars deve ser um valor entre 1 e 10',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid properties',
                'errors' => $validator->errors()
            ], 422);
        }

        $movie = Movie::find($movieId);

        if (is_null($movie)) {
            return response()->json(['message' => 'Invalid movie id'], 400);
        }

        $userId = AccessToken::where('tokenString', $request->bearerToken())->first()->userId;

        $review = Review::where('movieId', $movieId)->where('userId', $userId)->first();

        if (is_null($review)) {
            Review::create([
                'userId' => $userId,
                'movieId' => $movieId,
                'content' => $request->content,
                'stars' => $request->stars,
                'createdAt' => date_create()
            ]);

            return response()->json(['message' => 'Review has been successfully created'], 201);
        }

        $review->stars = $request->stars;

        if (!is_null($request->content)) {
            $review->content = $request->content;
        }

        $review->save();

        return response()->json(['message' => 'Review has been successfully updated']);
    }

    public function reviews(Request $request, $movieId)
    {
        $page = !is_null($request->query('page')) ? $request->query('page') : 1;
        $pageSize = !is_null($request->query('pageSize')) ? $request->query('pageSize') : 10;
        $sortDir = !is_null($request->query('sortDir')) ? $request->query('sortDir') : 'desc';
        $sortBy = !is_null($request->query('sortBy')) ? $request->query('sortBy') : 'score';

        $movie = Movie::find($movieId);

        if (is_null($movie)) {
            return response()->json(['message' => 'Invalid movie id'], 400);
        }

        $reviews = Review::selectRaw('
            review.*,
            COUNT(reviewevaluation.positive = 1) - COUNT(reviewevaluation.positive = 0) as score
        ')
            ->fromRaw('review, reviewevaluation')
            ->whereRaw('reviewevaluation.reviewId = review.id')
            ->where('review.movieId', $movieId)
            ->groupBy('review.id')
            ->orderBy($sortBy, $sortDir)
            ->paginate($pageSize, ['*'], '', $page);


        $reviews->getCollection()->transform(function ($review) {
            $userByReview = User::find($review->userId);

            $positiveEvaluations = ReviewEvaluation::where('reviewId', $review->id)
                ->where('positive', 1)
                ->count();

            $negativeEvaluations = ReviewEvaluation::where('reviewId', $review->id)
                ->where('positive', 0)
                ->count();

            $token = str_replace('Bearer ', '', FacadesRequest::header('Authorization'));
            $userId = AccessToken::where('tokenString', $token)->first()->userId;
            $myEvaluation = ReviewEvaluation::where('userId', $userId);

            if ($myEvaluation !== true || $myEvaluation !== false)
                $myEvaluation = null;

            return [
                'id' => $review->id,
                'username' => $userByReview->username,
                'content' => $review->content,
                'stars' => $review->stars,
                'score' => $positiveEvaluations - $negativeEvaluations,
                'createdAt' => $review->createdAt,
                'myEvaluation' => $myEvaluation
            ];
        });

        return response()->json($reviews->toArray()['data']);
    }

    public function delete(Request $request, $movieId) {
        $movie = Movie::find($movieId);

        if (is_null($movie)) {
            return response()->json(['message' => 'Invalid movie id'], 404);
        }

        $userId = AccessToken::where('tokenString', $request->bearerToken())->first()->userId;

        $reviewExists = Review::where('movieId', $movieId)
            ->where('userId', $userId)
            ->first();

        if (is_null($reviewExists)) {
            return response()->json(['message' => 'You haven´t published a review to this movie'], 404);
        }

        ReviewEvaluation::where('reviewId', $reviewExists->id)->delete();
        $reviewExists->delete();

        return response(null, 204);
    }
}
