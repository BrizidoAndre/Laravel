<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\Review;
use App\Models\ReviewEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewEvaluationController extends Controller
{
    public function create(Request $request, $reviewId) {
        $userId = AccessToken::where('tokenString', $request->bearerToken())->first()->userId;
        $review = Review::find($reviewId);

        $validator = Validator::make(
            $request->all(),
            [
                'positive' => 'required|integer|min:0|max:1'
            ],
            [
                'required' => 'O campo :attribute é obrigatorio',
                'integer' => 'O valor de positive deve ser 0 ou 1',
                'min' => 'O valor de positive deve ser 0 ou 1',
                'max' => 'O valor de positive deve ser 0 ou 1',
            ]
        );

        if (is_null($review)) {
            return response()->json(['message' => 'Invalid review id'], 400);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid properties',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($review->userId === $userId) {
            return response()->json(['message' => 'The user cant evaluate his own review'], 403);
        }

        $myEvaluation = ReviewEvaluation::where('reviewId', $reviewId)
            ->where('userId', $userId)
            ->first();

        if (is_null($myEvaluation)) {
            ReviewEvaluation::create([
                'reviewId' => $reviewId,
                'userId' => $userId,
                'positive' => $request->positive
            ]);

            return response()->json(['message' => 'Review evaluation has been successfully created'], 201);
        }

        $myEvaluation->positive = $request->positive;
        $myEvaluation->save();

        return response()->json(['message' => 'Review evaluation has been successfully updated']);
    }

    public function delete(Request $request, $reviewId) {
        $userId = AccessToken::where('tokenString', $request->bearerToken())->first()->userId;
        $review = Review::find($reviewId);

        if (is_null($review)) {
            return response()->json(['message' => 'Invalid review id'], 400);
        }

        $myEvaluation = ReviewEvaluation::where('reviewId', $reviewId)
        ->where('userId', $userId)
        ->first();

        if (is_null($myEvaluation)) {
            return response()->json(['message' => 'You haven´t published a evaluation to this review'], 404);
        }

        $myEvaluation->delete();

        return response(null, 204);
    }
}
