<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ImageRequest;
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
    public function store(ImageRequest $request)
    {
        $file = $request->file('file');
        $path = Storage::putFile('public/images', $file);
        $link = new Link();
        $link->name = $file->getClientOriginalName();
        $link->image = $path;
        $link->save();
        Log::info('uploaded.', compact('path'));

        return new Response();
    }
}
