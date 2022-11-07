@extends('layout.dashborad')
@section('name', 'User Chat')

@section('btn')
@endsection

@section('css')
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h3 class="card-title ">User Chats</h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">

                    <style>
                        ::-webkit-scrollbar {
                            width: 8px;
                        }

                        ::-webkit-scrollbar-track {
                            width: 8px;
                            background: #f5f5f5;
                        }

                        ::-webkit-scrollbar-thumb {
                            width: 5em;
                            background-color: #ddd;
                            outline: 1px solid slategrey;
                            border-radius: 1rem;
                        }

                        .text-small {
                            font-size: 0.9rem;
                        }

                        .messages-box,
                        .chat-box {
                            height: 700px;
                            overflow-y: scroll;
                        }

                        .rounded-lg {
                            border-radius: 0.5rem;
                        }

                        input::placeholder {
                            font-size: 0.9rem;
                            color: #000;
                        }
                    </style>

                    <div class="container py-5 px-4">
                        <!-- For demo purpose-->

                        <div class="row rounded-lg overflow-hidden shadow">
                            <!-- Users box-->
                            <div class="col-4 px-0">
                                <div class="bg-white">
                                    <div class="bg-gray px-4 py-2 bg-light">
                                        <p class="h5 mb-0 py-1" style="color:black;">Recent</p>
                                    </div>
                                    <div class="messages-box">
                                        <div class="list-group rounded-0">
                                            @foreach ($chats as $chat)
                                                <a class="list-group-item list-group-item-action rounded-0 @if ($chat->id == $chat_id) active @endif"
                                                    id="msguser" style="cursor: pointer" href="{{ route('admin.users.chat', [$user_id,$chat->id]) }}">
                                                    <div class="form-group media">
                                                        <img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                                            alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">
                                                                    {{ $chat->user->firstname }}
                                                                    {{ $chat->user->lastname }}
                                                                </h6>
                                                                <small
                                                                    class="small font-weight-normal">{{ $chat->lastMsg->first()?->created_at->format('d M') }}</small>
                                                            </div>
                                                            <p class="font-italic mb-0 text-small">
                                                                @switch($chat->lastMsg->first()->type)
                                                                    @case('message')
                                                                        {{ substr($chat->lastMsg->first()->message, 0, 45) }}..
                                                                        @break
                                                                    @case('attachment')
                                                                        <i class="mdi mdi-attachment"></i> Attachments
                                                                        @break
                                                                    @case('agreement')
                                                                        @break
                                                                    @case('call')
                                                                        @break
                                                                @endswitch
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Chat Box-->
                            <div class="col-8 px-0">
                                <div class="chat-box bg-white pt-5">
                                    @foreach ($recMsgs as $recMsg)
                                            <!-- Sender Message-->
                                            <div class="media w-50 mb-3">
                                                <div class="media-body ml-3">
                                                    <div class="bg-{{($recMsg->user->id === $user_id)?"light":"primary"}} rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-{{($recMsg->user->id === $user_id)?"muted":"white"}}">
                                                            @if ($recMsg->message !== null)
                                                                {{ $recMsg->message }}
                                                            @else
                                                                @foreach ($recMsg->attachments as $attach)
                                                                    <i class="mdi mdi-attachment">{{ $attach }}</i>
                                                                @endforeach
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <p class="small text-muted">{{ $recMsg?->created_at->format('d M') }}</p>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                                <div class="bg-white d-flex justify-content-center align-items-center">
                                    @php
                                        $chat = $recMsgs->first()->chat;
                                        $title = $chat->blocked? 'Activate':'Block';
                                    @endphp
                                    <!-- Typing area -->
                                    <div class="ms-1 p-2 d-flex justify-content-center align-items-center">
                                        <form method="POST" action="{{ route('admin.users.chat.block', ['chat' => $chat_id, 'user' => $user_id]) }}" class="me-1">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $chat->blocked ? 'warning':'danger' }} fw-bold" title="{{ $title }} User"
                                                style="color:black;cursor: pointer">{{ $title }} Chat</button>
                                        </form>
                                        <form action="{{ route('admin.users.chat.upload', ['chat' => $chat_id, 'user' => $user_id]) }}" method="POST" class="ms-1" enctype="multipart/form-data"
                                            style="position: relative;">
                                            @csrf
                                            <button class="btn btn-primary fw-bold" title="Upload File"
                                                style="color:black;cursor: pointer;">Upload File</button>
                                            <input type="file" name="file"
                                                style="opacity: 0;position: absolute;top: 0;left: 0;cursor: pointer">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    @endsection

@push('js')
<script>
    $('.chat-box').prop({ scrollTop: $('.chat-box').prop('scrollHeight') })
</script>
@endpush
