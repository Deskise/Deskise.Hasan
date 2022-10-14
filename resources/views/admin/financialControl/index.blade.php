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
                {{-- @dump($values->get('0')->id) --}}
                <form class="forms-sample" method="POST" action="{{ route("admin.financialControl.updateProfitRate",$values->get('0')->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <label for="profitRate" class="col-sm-4 col-form-label">Profit Rate:</label>
                        <input type="text" name="profitRate" id="profitRate" class="form-control" placeholder="Enter Profit Rate" aria-label="Enter Profit Rate" value="{{$values[0]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                    <button type="submit" id="updateProfitRate" class="btn btn-success btn-flat" >Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="forms-sample" method="POST" action="{{ route("admin.financialControl.updateTaxRate",$values->get('1')->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <label for="taxRate" class="col-sm-4 col-form-label">Tax Rate:</label>
                        <input type="text" name="taxRate" id="taxRate" class="form-control" placeholder="Enter Tax Rate" aria-label="Enter Tax Rate" value="{{$values[1]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                    <button type="submit" id="updateTextRate" class="btn btn-success btn-flat" >Update</button>
                            </div>
                        </div>
                    </div>
                </form>


                <form class="forms-sample" method="POST" action="{{ route("admin.financialControl.updateBankCommission",$values->get('2')->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <label for="bankCommission" class="col-sm-4 col-form-label">Bank Commission:</label>
                        <input type="text" name="bankCommission" id="bankCommission" class="form-control" placeholder="Enter Profit Rate" aria-label="Enter Profit Rate" value="{{$values[2]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                    <button type="submit" id="updateBankCommission" class="btn btn-success btn-flat" >Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="forms-sample" method="POST" action="{{ route("admin.financialControl.updateWithdrawLimits",$values->get('3')->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <label for="withdrawLimit" class="col-sm-4 col-form-label">Withdraw Limit:</label>
                        <input type="text" name="withdrawLimit" id="withdrawLimit" class="form-control" placeholder="Enter Withdraw Limit" aria-label="Enter Withdraw Limit" value="{{$values[3]->value}}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                    <button type="submit" id="updateWithdrawLimit" class="btn btn-success btn-flat" >Update</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush




