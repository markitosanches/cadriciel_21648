@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="card-body">
            <!-- list-->
            <chat-messages></chat-messages>
        </div>
        <div class="card-footer">
            <!-- form-->
            <chat-form></chat-form>
        </div>
    </div>
</div>
    
@endsection