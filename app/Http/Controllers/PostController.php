<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::all();
        foreach ($items as $item) {
            $count = 0;
            if($item->likes != null){
            foreach ($item->likes as $like) {
                $count = $count + $like->add;
                }
            }
            $update = [
                'count' => $count,
            ];
            Post::where('id', $item->id)->update($update);
        }

        $items = Post::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Post::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $item = Post::find($post);
        Foreach ($item as $comment)
        {
            $param = $comment->comments;
        }
        if ($item) {
            return response()->json([
                'data' => $item,
                'param' => $param
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $item = Post::find($post->id);
        $count = 0;
        foreach ($item->likes as $like) {
            $count = $count + $like->add;
        }
        $update = [
            'count' => $count,
        ];
        $item = Post::where('id', $post->id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $item = Post::where('id', $post->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    
}
