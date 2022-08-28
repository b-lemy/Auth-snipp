<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcreateRequest;
use App\Http\Resources\PostResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');

    }

    public function index()
    {
        $post = Posts::paginate();

        return PostResource::collection($post);
    }


    public function store(PostcreateRequest $request)
    {
        $post = Posts::create($request->only('title', 'description', 'image'));
        return response($post, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $post = Posts::find($id);
        return new PostResource($post);
    }


    public function update(Request $request, $id)
    {
        $post = Posts::find($id);
        $post->update($request->only('title', 'description', 'image'));

        return response($post, Response::HTTP_ACCEPTED);


    }


    public function destroy($id)
    {
        Posts::destroy($id);

        return \response(null, Response::HTTP_NO_CONTENT);
    }
}
