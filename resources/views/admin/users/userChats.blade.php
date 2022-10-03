@extends('layout.dashborad')
@section('name','User Chat')

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

                                                <a class="list-group-item list-group-item-action active text-white rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">25 Dec</small>
                                                            </div>
                                                            <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">14 Dec</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur. incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">9 Nov</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">18 Oct</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">17 Oct</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">2 Sep</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">30 Aug</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">21 Aug</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">14 Dec</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur. incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">9 Nov</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">18 Oct</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">17 Oct</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">2 Sep</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">30 Aug</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">21 Aug</small>
                                                            </div>
                                                            <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chat Box-->
                                <div class="col-8 px-0">
                                    <div class="chat-box bg-white p-1">
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach to have</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                        <!-- Sender Message-->
                                        <div class="media w-50 mb-3">
                                            <div class="media-body ml-3">
                                                <div class="bg-light rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>

                                        <!-- Reciever Message-->
                                        <div class="media w-50 ml-auto mb-3">
                                            <div class="media-body">
                                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                                </div>
                                                <p class="small text-muted">12:00 PM | Aug 13</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-white d-flex justify-content-center align-items-center" style="border-radius: 2px;">
                                        <!-- Typing area -->
                                        <div class="ms-1 p-2 d-flex justify-content-center align-items-center">
                                            <form action="#" class="me-1">
                                                <a class="btn btn-danger fw-bold" href="#" title="Block User" style="color:black;cursor: pointer"> Block</a>
                                            </form>

                                            <form action="#" class="ms-1" enctype="multipart/form-data" style="position: relative;">
                                                <button class="btn btn-primary fw-bold" title="Upload File" style="color:black;cursor: pointer;"> Upload File</button>
                                                <input type="file" style="opacity: 0;position: absolute;top: 0;left: 0;cursor: pointer">
                                            </form>
                                        </div>
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


@endpush
