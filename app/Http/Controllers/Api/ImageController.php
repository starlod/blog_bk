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
     * イメージ 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        return Link::orderby('updated_at', 'desc')->paginate(20)->toJson();
    }

    /**
     * イメージ 追加
     *
     * @param ImageRequest $request
     * @return View
     */
    public function store(ImageRequest $request)
    {
        $file = $request->file('file');
        $path = Storage::disk('public')->putFile('images', $file);
        $link = new Link();
        $link->name = $file->getClientOriginalName();
        $link->path = $path;
        $link->save();
        Log::info('uploaded.', compact('path'));

        return new Response();
    }
}
