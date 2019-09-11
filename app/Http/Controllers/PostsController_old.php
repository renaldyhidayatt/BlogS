<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Posts;
use App\Category;
use App\Tag;
use App\Http\Requests\Posts\UpdatePostsRequest;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('VerifCategoriesCount')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        return view('posts.index')->with('posts',Posts::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts');
        $posts = Posts::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category
        ]);

        if ($request->tags) {
            $posts->tags()->attach($request->tags);
        }
        session()->flash("success", "Posts Created SuccessFully");

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        return view('posts.create')->with('posts', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Posts $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content','category_id' => $request->category]);
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
        session()->flash("success", "Posts Updated SuccessFully");
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        } else{
            $post->delete();
        }
        session()->flash("success", "Posts Deleted SuccessFully");
        return redirect(route('posts.index'));
    }
    /**
     * Trash posts display.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed = Posts::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }
    public function restore($id){
        $post = Posts::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash("success", "Posts Restored SuccessFully");
        return redirect()->back();
    }
}
