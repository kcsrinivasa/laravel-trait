<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Traits\ImageTrait;
use Hash;

class UserController extends Controller
{
     use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user')->withUsers(User::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        /* use trait file upload function  **/
        $image = $this->uploadFile($request, 'image', 'images');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
            'password' => Hash::make($request->email),
        ]);
        session()->flash('success','Successfully added the user');
        return redirect(route('user.index'));
    }


}
