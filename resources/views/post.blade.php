@extends('layouts.app')

@section('title')
    {{ config('app.name') }} | Post
@endsection
@section('content')

<div class="container my-5">

    <div class="card">
        <div class="card-header">Add Post Record  <a class="btn btn-success btn-sm float-end" href="{{ url('/') }}">Home</a></div>
        <div class="card-body">
           <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="input-group mb-3">
                  <span class="btn btn-info ">Name</span>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name"  title="@error('name') Name is required @enderror">

                  <span class="btn btn-info ">Image</span>
                  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Image"  title="@error('image') Image is required @enderror" accept="image/*">

                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
           </form>

           @include('partial.success')
           @include('partial.error')
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">Post Records </div>
        <div class="card-body">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->name}}</td>
                    <td>
                        @if( $post->image)
                          <img src="{{asset($post->image)}}" width="150">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
  
    
</div>
@endsection
