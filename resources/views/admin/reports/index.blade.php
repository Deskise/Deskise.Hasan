@extends('layout.dashborad')
@section('name','Reports')
@section('btn')
@endsection
@section('css')
@endsection
@section('content')

    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title">Chat Reports</h4>--}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Chat ID </th>
                                <th> From </th>
                                <th> Message (In short) </th>
                                <th> Status </th>
                                <th> More Details </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chatReports as $chatReport)
                            <tr>
                                <td>{{$chatReport->chat_id}}</td>
                                <td> {{$chatReport->user->email}} </td>
                                <td> {!! Str::words($chatReport->message,8) !!}.. </td>
                                <td>
                                    <div class="badge @if($chatReport->status==='accepted') badge-outline-success @elseif($chatReport->status==='rejected') badge-outline-danger @elseif($chatReport->status==='checking') badge-outline-primary @else badge-outline-warning @endif">{{$chatReport->status}}</div>
                                </td>
                                <td> <a class="btn btn-outline-info " href="{{route('admin.reports.show',$chatReport->id)}}" title="Show">Show</a> </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                        <div class="align-self-center">{{ $chatReports->links() }}</div>
            </div>
        </div>
    </div>



@endsection

@section('js')

@endsection


