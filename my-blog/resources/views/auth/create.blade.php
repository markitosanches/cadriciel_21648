@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <form action="{{route('auth.create')}}" method="post">
                    @csrf
                    <div class="card-header text-center">
                        <h1 class="display-6">Register</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                               <span class="text-danger">{{$errors->first('name')}}</span> 
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                            @error('email')
                               <span class="text-danger">{{$errors->first('email')}}</span> 
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                               <span class="text-danger">{{$errors->first('password')}}</span> 
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-center">
                            <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection