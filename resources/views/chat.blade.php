@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-header bg-primary text-light">Conversaciones</h5>
                    <div class="list-group list-group-flush">
                        @foreach ($conversations as $conv)
                            <a
                                class="list-group-item list-group-item-action"
                                href="{{ route('chat.index', $conv) }}">
                                {{ $conv->getOther(Auth::user())->name ?? 'Sin Conversaciones' }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9 mt-5 my-lg-0">
                <div class="container-fluid">
                    @if ($conversation)
                        <chat-app
                            user="{{ Auth::user() }}"
                            send="{{ route('messages.store', $conversation) }}"
                            fetch="{{ route('messages', $conversation) }}"
                            receptor-profile="{{ route('ukeprofe.show', $receptor)}}"
                                receptor-avatar="{{ asset('storage/' . $receptor->img) }}"
                            :receptor='@json($receptor)'>
                        </chat-app>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
