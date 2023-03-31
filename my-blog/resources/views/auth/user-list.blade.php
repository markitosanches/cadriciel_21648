@extends('layouts.app')
@section('title', 'User List')
@section('content')
<div class="row">
    <div class="col-12 text-center pt-3">
        <h1 class="display-3 mt-3"> User List</h1>
    </div>
    <hr>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Post</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->userHasPosts as $post)
                          <p>{{ $post->title }}</p>
                        @endforeach        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users}}
    </div>
</div>
@endsection