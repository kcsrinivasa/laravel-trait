@extends('layouts.app')

@section('title')
    {{ config('app.name') }} | User
@endsection

@section('content')

<div class="container my-5">

    <div class="card">
        <div class="card-header">Add User Record  <a class="btn btn-success btn-sm float-end" href="{{ url('/') }}">Home</a></div>
        <div class="card-body">
           <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="input-group mb-3">
                  <span class="btn btn-info ">Name</span>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name"  title="@error('name') Name is required @enderror">

                  <span class="btn btn-info ">Email</span>
                  <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email"  title="@error('email') Email is required @enderror">

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
        <div class="card-header">User Records </div>
        <div class="card-body">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if( $user->image)
                          <img src="{{asset($user->image)}}" width="50">
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
