@extends('layout.dashborad')
@section('name', 'User Reports')

@section('content')

    <div class="content-wrapper d-flex align-items-center justify-content-center">
            <div class="col-lg-6 pt-3 h-100">
                @php
                $role = request()->user()->role;
                @endphp

                <div class="contact-wrap w-100 md-2">
                    <h3 class="mb-4 text-center align-self-center h-100">Send Message To User</h3>
                    <form method="POST" action="{{ route('admin.users.sendMsg',$user->id) }}" id="message-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="type" id="type"
                                        value="@if($role == 'super') admin @else normal @endif">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fs-6" for="name"></label>
                                    <input type="text" class="form-control" title="The User Full Name"  name="name" id="name"
                                        placeholder="Full Name" value="{{ $user->firstname }} {{ $user->lastname }}" style="background: #2A3038" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fs-6" for="title"></label>
                                    <input type="text" class="form-control" name="title" id="title" title="Enter Message Subject"
                                    placeholder="Subject">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fs-6" for="body"></label>
                                    <textarea name="body" class="form-control" id="body" title="Enter The Message Body" cols="30" rows="10" placeholder="Message"
                                    style="height: 200px;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fs-6" for="image"></label>
                                    <input type="file" name="image" class="form-control file-upload-info">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group text-center align-self-center h-100">
                                    {{-- <button type="submit" class="btn btn-success btn-flat" >Send Message</button> --}}
                                    <button type="button" class="btn btn-success btn-flat" onclick="sendMessage()">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-database.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyC8_pp1WJSTtYcYjoFrUi4c_6m8V9fRjCs",
            authDomain: "notifications-a4985.firebaseapp.com",
            databaseURL: "https://notifications-a4985-default-rtdb.firebaseio.com",
            projectId: "notifications-a4985",
            storageBucket: "notifications-a4985.appspot.com",
            messagingSenderId: "215769236601",
            appId: "1:215769236601:web:c565881735e796b63480a8"
        };
        firebase.initializeApp(firebaseConfig);
        var userId = {{ $user->id }};
        function sendMessage() {
            var db = firebase.database();
            var notificationsRef = db.ref(`notifications/${userId}`);

            var message = {
                user_id: userId,
                user: document.getElementById('name').value,
                title: document.getElementById('title').value,
                body: document.getElementById('body').value,
                read: false
            };
            notificationsRef.push(message)
                .then(function() {
                    console.log("Message sent to Firebase.");
                    document.getElementById('message-form').submit();
                })
                .catch(function(error) {
                    console.error("Error sending message to Firebase:", error);
                });
        }
    </script>
@endsection

@push('js')
@endpush
