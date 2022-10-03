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
                        <h3 class="card-title ">User Reports Page</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Chat ID </th>
                                    <th> Message (In short) </th>
                                    <th> Status </th>
                                    <th> More Details </th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach($chatReports as $chatReport)--}}
                                    <tr>
                                        <td></td>
                                        <td> </td>
                                        <td>
{{--                                            <div class="badge @if($chatReport->status==='approved') badge-outline-success @elseif($chatReport->status==='rejected') badge-outline-danger @elseif($chatReport->status==='waiting') badge-outline-primary @else badge-outline-warning @endif">{{$chatReport->status}}</div>--}}
                                        </td>
{{--                                        <td> <a class="btn btn-outline-info " href="{{route('admin.reports.show',$chatReport->id)}}" title="Show">Show</a> </td>--}}
                                        <td>  </td>
                                    </tr>
{{--                                @endforeach--}}

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="align-self-center"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')


@endpush
