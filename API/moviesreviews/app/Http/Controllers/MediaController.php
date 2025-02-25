<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function media(Request $request, $mediaId)
    {
        $responseJpg = Http::get(asset("public/storage/media/$mediaId.jpg"));
        $responseMp4 = Http::get(asset("public/storage/media/$mediaId.mp4"));
        
        
        switch ($mediaId) {
            case $responseJpg->status() === 200:
                return response($responseJpg->body(), 200, ['content-type' => 'image/jpeg']);
                break;

            case $responseMp4->status() === 200:
                return response($responseMp4->body(), 200, ['content-type' => 'video/mp4']);
                break;

            default:
                return response()->json(['message' => 'Could not find any file with the id <mediaId>'], 404);
                break;
        }
    }
}
