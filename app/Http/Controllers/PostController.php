<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggested_users = auth()->user()->suggested_users();
        $ids = auth()->user()->following()->wherePivot("confirmed" , true)->get()->pluck("id");
        $posts = Post::whereIn("user_id", $ids)->latest()->get();
        return view('posts.index', compact(['posts', 'suggested_users']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['required', 'mimes:jpg,jpeg,png,gif']
        ]);
        $image = $request['image']->store('posts', 'public');
        $data['image'] = $image;
        $data['slug'] = Str::random(10);

        auth()->user()->posts()->create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize("delete", $post );
        unlink(storage_path('app/public/' . $post->image));
        $post->delete();
        
        return redirect()->route('home');
    }
    public function explore(){
        $posts = Post::whereRelation("owner", "private_account", "=", 0)
        ->whereNot('user_id', auth()->id())
        ->simplePaginate(12);
        return view("posts.explore", compact("posts"));
    }
}
