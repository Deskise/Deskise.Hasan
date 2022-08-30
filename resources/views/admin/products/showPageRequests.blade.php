@extends('layout.dashborad')
@section('name','products')
@section('btn')

@endsection
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
                <h1> show Page Requests! </h1>

            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush


