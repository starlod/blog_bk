<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Log;
use Storage;
use App\Link;

class ImageController extends Controller
{
    /**
     * イメージ 追加
     *
     * @param ImageRequest $request
     * @return View
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path =  Storage::putFile('public/images', $file);
            $link = new Link();
            $link->name = 'テスト画像';
            $link->image = $path;
            $link->save();
            Log::info('uploaded.', compact('path'));
        } else {
            Log::info('have not file.');
        }

        return new Response();
    }
}
