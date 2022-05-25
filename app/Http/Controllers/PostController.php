<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Traits\ImageTrait;

class PostController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post')->withPosts(Post::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* use trait file upload function  **/
        $image = $this->uploadFile($request, 'image', 'posts');;

        Post::create([
            'name' => $request->name,
            'image' => $image,
        ]);
        session()->flash('success','Successfully added the post');
        return redirect(route('post.index'));
    }

}
