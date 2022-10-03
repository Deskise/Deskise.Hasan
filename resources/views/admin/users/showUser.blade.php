@extends('layout.dashborad')
@section('name','User Details')
@section('btn')
@endsection
@section('css')

@endsection
@section('content')


<div class="bg-white border rounded-5">

    <section class="w-100 p-4" style="border-radius: .5rem .5rem 0 0;">

        <div class="row">
            <div class="col">

                <nav aria-label="breadcrumb" class="bg-dark rounded-3 p-2 mb-3">
                    <div class="row">
                        <div class="col-lg-8">
                            <ol class="breadcrumb mb-0 m-2 fs-6">
                                <li class="breadcrumb-item" aria-current="page"><a class="text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a class="text-decoration-none" href="{{route('admin.users.index')}}">Users</a></li>
                                <li class="breadcrumb-item" aria-current="page">User Details</li>
                            </ol>
                        </div>
                        <div class="col-lg-4 col-sm-3">
                        <div class="d-flex justify-content-center  p-2">
                            <a class="btn btn-outline-warning m-2" href="{{route('admin.users.reports',$user->id)}}" title="User Reports">User Reports</a>
                            <a class="btn btn-outline-info m-2" href="{{route('admin.users.chat',$user->id)}}" title="User Chats">User Chat</a>
                        </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{$user->img}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$user->firstname}} {{$user->lastname}}</h5>
                        <div class="d-flex justify-content-center mb-2">
                            @php
                              $title = $user->banned? 'Activate':'Ban';
                            @endphp
                            <a class="btn btn-outline-{{$user->banned ? 'warning':'danger'}} m-2" href="{{route('admin.users.update',$user->id)}}" title="{{$title}} User">{{$title}} User</a>
                            <form action="#" method="post">
{{--                                @csrf--}}
{{--                                @method('PUT')--}}
                                 <button type="submit" class="btn btn-outline-primary sendMessage m-2" href="#" title="Message User">Message User</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-4" style="font-family:Rubik, sans-serif;">
                            <li class="list-group-item d-flex justify-content-between align-items-center  ps-3" style="background: rgba(27,30,38,0.93); color:#fff;">
                                <i class="mdi mdi-facebook-box fs-3" style="color: #3460bd;"></i>
                                <p class="mb-0" >{{$user->facebook_id ?? 'Not Verified'}} </p>
                            </li>
                            <hr style="color:#ffffff;">
                            <li class="list-group-item d-flex justify-content-between align-items-center ps-3" style="background: rgba(27,30,38,0.93); color:#fff;">
                                <i class="mdi mdi-google fs-3" style="color: #ef1847;"></i>
                                <p class="mb-0" >{{$user->google_id ?? 'Not Verified'}}</p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->firstname}} {{$user->lastname}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Backup Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->backup_email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->phone}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Backup Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->backup_phone}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->location}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Is Closed</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">@if($user->is_closed) Yes @else No @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">IS Hidden</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">@if($user->is_hidden) Yes @else No @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Is Banned</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">@if($user->banned) Yes @else No @endif</p>
                                </div>
                            </div>
                            <hr>
                    </div>
                </div>

        </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h4 class="card-title">User Products</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Product Name</th>
                                    <th>Category Name</th>
                                    <th> Product Price ($)</th>
                                    <th> Profit Earning ($)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Linda Cassin </td>
                                    <td> Category Test1 </td>
                                    <td> 100 </td>
                                    <td> 20 </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Bennett Sauer </td>
                                    <td> Category Test2 </td>
                                    <td> 100 </td>
                                    <td> 20 </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> Ken Klocko </td>
                                    <td> Category Test3 </td>
                                    <td> 100 </td>
                                    <td> 20 </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Shirley Howell </td>
                                    <td> Category Test1 </td>
                                    <td> 100 </td>
                                    <td> 20 </td>
                                </tr>

                                </tbody>
                            </table>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br>


    </section>
</div>



@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        $('.sendMessage').click(async function (event) {
            event.preventDefault();
            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Message',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true,
                confirmButtonText: 'Send'
            })

            if (text) {
                // Swal.fire(text)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Message Sent Successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });

    </script>
@endsection


