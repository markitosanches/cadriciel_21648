@extends('layouts.app')
@section('title', 'New Password')
@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-6">
            @if(!$errors->isEmpty())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-header text-center">
                        <h1 class="display-6">New Password</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="c_password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="c_password" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                            <input type="submit" value="New password" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection