@extends('layout.dashborad')
@section('name','Products')
@section('css')
    .table-hover > tbody > tr:hover > *{
    --bs-table-hover-bg: white;
    color: black;
    }
@endsection
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="category-table"
                           class="table table-hover">
                        <thead>
                        <tr style="boder:1px solid black;">
                            <th>User Name</th>
                            <th>Identity</th>
                            <th class="text-center action-btn">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>
                                    <img src="{{$user->img}}" alt="">
                                    {{  $user->firstname .' ' .$user->lastname }}
                                </td>

                                <td onclick="show_popup({{ json_encode(collect($user->assets->assets)->map(
                                function ($el) {
                                    return route('images', ['for'=>'user_assets', 'image'=>$el]);
                                }
                            ), JSON_THROW_ON_ERROR)
                            }})">
                                    @foreach($user->assets->assets as $key => $image)
                                        @php
                                            $left = $key*-15 . 'px';
                                        @endphp
                                        @if ($key < 3)
                                            <img src="{{ route('images', ['for'=>'user_assets', 'image'=>$image]) }}"
                                                 class="position-relative d-inline-block" style="left: {{ $left }};"
                                                 height="200">
                                        @else
                                            <div class="text-white position-relative d-inline-flex"
                                                 style="height: 33px;width: 33px;background:#000000db;justify-content: center;align-items: center;border-radius: 50%; left: {{ $left }}">
                                                ...
                                            </div>
                                            @break
                                        @endif
                                    @endforeach
                                </td>

                                <td class="text-center">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a type="button" href='{{ url("admin/get_user_IDs/verify_ID/".$user->id) }}'
                                               class="btn btn-outline-success btn-md" title="verify">
                                                verify <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a type="button" href='{{ url("admin/get_user_IDs/reject_ID/".$user->id) }}'
                                               class="btn btn-outline-warning btn-md" title="cancel">
                                                cancel <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <style>
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0, 0, 0); /* Fallback color */
                background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
                justify-content: center;
                align-items: center;
                z-index: 9999;
                padding: 0;
            }

            /* Modal Content (Image) */
            .modal-content {
                margin: auto;
                display: block;
                width: 40%;
                max-width: 700px;
            }

            @keyframes zoom {
                from {
                    transform: scale(0)
                }
                to {
                    transform: scale(1)
                }
            }

            /* The Close Button */
            .close {
                position: absolute;
                top: 2%;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
            }

            .arrow {
                position: absolute;
                top: 50%;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
                cursor: pointer;
            }

            .arrow.next {
                right: 35px;
                z-index: 9;
            }

            .arrow.prev {
                left: 35px;
            }

            .close:hover,
            .close:focus {
                color: #bbb;
                text-decoration: none;
                cursor: pointer;
            }

            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px) {
                .modal-content {
                    width: 100%;
                }
            }
        </style>

        <!-- The Close Button -->
        <span class="close" onclick="hide_popup()">&times;</span>

        <div class="arrow next" onclick="next_img()">></div>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <div class="arrow prev" onclick="prev_img()"><</div>
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>


    <script>
        var modal = document.getElementById("myModal"),
            next = document.querySelector('.arrow.next'),
            prev = document.querySelector('.arrow.prev'),
            image = 0,
            modalImg = document.getElementById("img01"),
            images;

        function show_popup(imgs) {
            modal.style.display = "flex";
            images = imgs;
            modalImg.src = images[0];
            prev.style.display = "none";
        }

        function next_img() {
            modalImg.src = images[++image];

            prev.style.display = "initial";
            if (image === images.length - 1)
                next.style.display = "none";

        }

        function prev_img() {
            modalImg.src = images[--image];

            next.style.display = "initial";
            if (image === 0)
                prev.style.display = "none";
        }

        function hide_popup() {
            modal.style.display = "none";
        }
    </script>

@endsection


