@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <chat-log :messages="messages"></chat-log>
            <chat-composer v-on:messagesent="addMessage"></chat-composer>
        </div>
    </div>
@endsection
