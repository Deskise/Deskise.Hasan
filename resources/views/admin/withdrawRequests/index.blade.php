@extends('layout.dashborad')
@section('name','Withdraw Requests')

@section('css')
    .table-hover > tbody > tr:hover > *{
    --bs-table-hover-bg: white;
    color: black;
    }
@endsection
@section('content')


    <div class="row">
        <div class="card" >
            <div class="card-body">
        <div class="table-responsive">
            <table id="category-table" class="table table-hover ">
                <thead>
                <tr style="boder:1px solid black;">
                    <th>ID</th>
                    <th>User Name</th>
                    <th>ُEmail</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th></th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                  @foreach ($withdrawList as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                        <td class="m-1">
                            <img src="{{$item->user->img}}" alt="">
                            {{ $item->user->firstname.' ' .$item->user->lastname }}
                        </td>
                        <td class="m-1">{{ $item->user->email }}</td>
                        <td class="m-1">{{ $item->amount }}$</td>
                        <td style="max-width: 350px;white-space: break-spaces;" colspan="2">{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>
                        <div class="badge @if($item->status==='approved') badge-outline-success @elseif($item->status==='declined') badge-outline-danger @elseif($item->status==='checking') badge-outline-primary @else badge-outline-warning @endif">{{$item->status}}</div>  
                        </td>
                        <td class="d-flex align-items-center justify-content-evenly">
                            <form method="post" action="{{route('admin.withdrawRequests.remove',$item->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-flat show_confirm mr-1"
                                        data-toggle="tooltip" title='Delete Product'><i class="mdi mdi-delete-forever"></i>
                                </button>
                            </form>

                            <form method="POST" action="{{route('admin.withdrawRequests.approve',$item->id)}}" id="approve-form">
                                @csrf
                                @method('PUT')
                                <button type="button" onclick="approve({{$item->id}})" class="btn btn-success btn-flat show_confirm mr-1" data-toggle="tooltip" title='Approve Request'>
                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                </button>
                            </form>

                            <form method="POST" action="{{route('admin.withdrawRequests.decline', $item->id)}}" id="decline-form">
                                @csrf
                                @method('PUT')
                                <button type="button" onclick="decline({{$item->id}})" class="btn btn-danger btn-flat show_confirm mr-1"
                                        data-toggle="tooltip" title='Decline Request'><i class="mdi mdi-block-helper"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            </div>

                <div class="align-self-center d-flex align-items-center justify-content-center">{{ $withDraw->links() }}</div>
        </div>
    </div>

@endsection

@section('js')

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
        
        function approve(id) {
            console.log(id);
            var userId = {{$item->user_id}};
            var db = firebase.database();
            var notificationsRef = db.ref(`notifications/${userId}`);

            var message = {
                user_id: userId,
                title: 'Withdraw Request',
                body: 'Your last Withdraw Request was approved, You can check your dashboard',
                read: false
            };
            notificationsRef.push(message)
                .then(function() {
                    console.log("Message sent to Firebase.");
                    var form = document.getElementById('approve-form');
                    form.action = "{{ route('admin.withdrawRequests.approve', '') }}" + "/" + id;
                    form.submit();
                    // document.getElementById('approve-form').submit();
                })
                .catch(function(error) {
                    console.error("Error sending message to Firebase:", error);
                });
        }

        function decline(id) {
            console.log(id);
            var userId = {{$item->user_id}};
            var db = firebase.database();
            var notificationsRef = db.ref(`notifications/${userId}`);

            var message = {
                user_id: userId,
                title: 'Withdraw Request',
                body: 'Your last Withdraw Request was declined.',
                read: false
            };
            notificationsRef.push(message)
                .then(function() {
                    console.log("Message sent to Firebase.");
                    var form = document.getElementById('decline-form');
                    form.action = "{{ route('admin.withdrawRequests.decline', '') }}" + "/" + id;
                    form.submit();
                    // document.getElementById('approve-form').submit();
                })
                .catch(function(error) {
                    console.error("Error sending message to Firebase:", error);
                });
        }
    </script>


@endsection


