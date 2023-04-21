@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="card-body">
            <!-- list-->
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <!-- form-->
            <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
        </div>
    </div>
</div>
    
@endsection