@extends('layout.dashborad')
@section('name','Financial Control')

@section('btn')
@endsection

@section('css')
@endsection

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body col-12 col-lg-6 pe-3 pe-lg-5">
                <h4 class="card-title pb-3">Financial Control Page</h4>
{{--                <p class="card-description"> Horizontal form layout </p>--}}
                {{-- form method: POST , Action: Update --}}
                <form class="forms-sample">
                    <div class="input-group mb-3">
                        <label for="profitRate" class="col-sm-3 col-form-label">Profit Rate:</label>
                        <input type="number" name="profitRate" id="profitRate" class="form-control" placeholder="Enter Profit Rate" aria-label="Enter Profit Rate">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="taxRate" class="col-sm-3 col-form-label">Tax Rate:</label>
                        <input type="number" name="taxRate" id="taxRate" class="form-control" placeholder="Enter Tax Rate" aria-label="Enter Tax Rate">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="bankCommission" class="col-sm-3 col-form-label">Bank Commission:</label>
                        <input type="number" class="form-control" name="bankCommission" id="bankCommission" placeholder="Enter Bank Commission" aria-label="Enter Bank Commission">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="withdrawLimit" class="col-sm-3 col-form-label">Withdraw Limits:</label>
                        <input type="number" class="form-control" name="withdrawLimit" id="withdrawLimit" placeholder="Enter Money Withdraw Limits" aria-label="Enter Money Withdraw Limits">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary me-2 p-3">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

@push('js')

@endpush




