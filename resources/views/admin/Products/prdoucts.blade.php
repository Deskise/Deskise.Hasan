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
        <div class="card" >
            <div class="card-body">
        <div class="table-responsive">
            <table id="category-table"
                   class="table table-hover">
                <thead>
                <tr style="boder:1px solid black;">
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>description</th>
                    <th>Price</th>
                    <th class="text-center action-btn">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $key => $txt)
                    <tr>
                        <td>
                            <img src="{{$txt->user->img}}" alt="">
                            {{  $txt->user->firstname .' ' .$txt->user->lastname }}
                        </td>
                        <td>{{ $txt->category->name_en }}</td>
                        <td><img src="{{$txt->img}}" alt=""> {{ $txt->name_en }}</td>
                        <td>{{ substr($txt->description_en,0,20) }}</td>
                        <td>{{ $txt->price  }}</td>

                        <td class="text-center">
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-6">--}}

{{--                                    <a type="button" onclick="openPopUp({{$txt->id}})"--}}
{{--                                       class="btn btn-outline-success btn-md" title="verify">--}}
{{--                                        verify <i class="mdi mdi-file-check btn-icon-append"></i>--}}
{{--                                    </a>--}}


{{--                                </div>--}}
                                <div class="col-sm-6">
                                    <a type="button" href='{{ url("admin/get_products/reject/".$txt->id) }}'
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



    <div class="modal" tabindex="-1" role="dialog" id="modalAccept">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Accept Product</h5>
                    <button type="button" class="close" onclick="cancel()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="cancel()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label> Url Product</label>
                        <input type="text" class="form-control" name="product_url" id="product_url" >

                    </div>


                    <input type="hidden" class="form-control" name="product_id" id="product_id" >

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="sendAccept()">حفظ</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel()">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        function openPopUp(id){
            $('#modalAccept').modal('show');
            $('#product_id').val(id);
        }

        function cancel(){
            $('#modalAccept').modal('hide');
        }

        function sendAccept(){


              $('#modalAccept').modal('hide');


              product_url =  $('#product_url').val();
              product_id =  $('#product_id').val();

                data={
                    '_token' :"{{csrf_token()}}" ,
                    'url' : product_url ,
                    'id' : product_id
                };


                $.ajax({
                    type:'POST',
                    url:'{{url('admin/acceptProduct')}}',
                    data:data,
                    success:function(data) {
                        location.reload();
                    }
                });

        }
    </script>

    @endpush


