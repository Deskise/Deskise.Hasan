@extends('layout.dashborad')
@section('name','User Reports')

@section('content')


    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h3 class="card-title ">User Reports Page</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Chat ID </th>
                                    <th> Message</th>
                                    <th>  </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($reports as $chatReport)
                                    <tr>
                                        <td>{{ $chatReport->chat_id }}</td>
                                        <td style="max-width: 350px;white-space: break-spaces;" colspan="2">{{ $chatReport->message }}</td>
                                        <td>
                                            <div class="badge @if($chatReport->status==='approved') badge-outline-success @elseif($chatReport->status==='rejected') badge-outline-danger @elseif($chatReport->status==='waiting') badge-outline-primary @else badge-outline-warning @endif">{{$chatReport->status}}</div>
                                        </td>
                                    </tr>
                            @endforeach

                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="align-self-center d-flex align-items-center justify-content-center">{{ $reports->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')


@endpush
