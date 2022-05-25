@extends('layouts.app')

@section('content')

<div class="container m-5 p-5">

   
   <div class="shadow p-3 rounded"><h2>Laravel - Trait</h2></div>

   <div class="text-center fw-bold fs-4  mt-5">
        <a href="{{ route('post.index') }}" class=" text-decoration-none"><li class="list-group-item">Add Post</li></a>
        <br>
        <a href="{{ route('user.index') }}" class=" text-decoration-none"><li class="list-group-item">Add User</li></a>
   </div>
</div>
@endsection

@section('style')
   
@endsection