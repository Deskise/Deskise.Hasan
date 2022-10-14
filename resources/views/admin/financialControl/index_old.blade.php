@extends('layout.dashborad')
@section('name','Financial Control')

@section('btn')
@endsection

@section('css')
@endsection

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body col-12 col-lg-8">
                <h4 class="card-title pb-3">Financial Control Page</h4>

                <form class="forms-sample">
                    <div class="input-group mb-3">
                        <label for="profitRate" class="col-sm-4 col-form-label">Profit Rate:</label>
                        <input type="text" name="profitRate" id="profitRate" class="form-control" placeholder="Enter Profit Rate" aria-label="Enter Profit Rate" value="{{$values[0]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            {{-- <div class="col-sm-5">
                                <form method="POST" action="">
                                    <a href='#'
                                        class="btn btn-behance btn-flat" title="Edit"><i class="mdi mdi-circle-edit-outline"></i>
                                    </a>
                                </form>
                            </div> --}}
                            <div class="col-sm-5">
                                <form method="POST" action="">
                                    <button type="submit" class="btn btn-success btn-flat">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="taxRate" class="col-sm-4 col-form-label">Tax Rate:</label>
                        <input type="text"  name="taxRate" id="taxRate" class="form-control" placeholder="Enter Tax Rate" aria-label="Enter Tax Rate" value="{{$values[1]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            {{-- <div class="col-sm-5">
                                <form method="POST" action="">
                                    <a href='#'
                                        class="btn btn-behance btn-flat" title="Edit"><i class="mdi mdi-circle-edit-outline"></i>
                                    </a>
                                </form>
                            </div> --}}
                            <div class="col-sm-5">
                                <form method="POST" action="">
                                    <button type="submit" class="btn btn-success btn-flat">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="bankCommission" class="col-sm-4 col-form-label">Bank Commission:</label>
                        <input type="text"  class="form-control" name="bankCommission" id="bankCommission" placeholder="Enter Bank Commission" aria-label="Enter Bank Commission" value="{{$values[2]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            {{-- <div class="col-sm-5">
                                <form method="POST" action="">
                                <a href='#'
                                    class="btn btn-behance btn-flat" title="Edit"><i class="mdi mdi-circle-edit-outline"></i>
                                </a>
                                </form>
                            </div> --}}
                            <div class="col-sm-5">
                                <form method="POST" action="">
                                    <button type="submit" class="btn btn-success btn-flat">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <form method="POST" action="{{ route('admin.financialControl.updateDetails',$values->get('3')) }}" >
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <label for="withdrawLimit" class="col-sm-4 col-form-label">Withdraw Limits:</label>
                            <input type="text" class="form-control" name="withdrawLimit" id="withdrawLimit" placeholder="Enter Money Withdraw Limits" aria-label="Enter Money Withdraw Limits" value="{{$values[3]->value}}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">$</span>
                            </div>
                            <div class="row">
                                {{-- <div class="col-sm-5">
                                    <form method="POST" action="">
                                        <a href='#'
                                            class="btn btn-behance btn-flat" title="Edit"><i class="mdi mdi-circle-edit-outline"></i>
                                        </a>
                                    </form>
                                </div> --}}
                                <div class="col-sm-5">
                                    {{-- <form method="POST"> --}}
                                        {{-- @csrf --}}
                                        {{-- @method('PUT') --}}
                                        <button type="submit" class="btn btn-success btn-flat">Update</button>
                                        {{-- <a href='{{ route('admin.financialControl.edit',$values->get('3')) }}'
                                            class="btn btn-behance btn-flat" title="Edit"><i class="mdi mdi-circle-edit-outline"></i>
                                        </a> --}}
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="form-group d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary me-2 p-3">Save Changes</button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush




