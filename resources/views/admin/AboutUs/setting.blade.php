@extends('layout.dashborad')
@section('name','Edit Home Page')
@section('css')
    .table-hover > tbody > tr:hover > *{
    --bs-table-hover-bg: white;
    color: black;
    }
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card" style="background-color: white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="category-table"
                               class="table table-hover">
                            <thead>
                            <tr style="boder:1px solid black;">
                                <th>Name</th>
                                <th>Content</th>
                                <th class="text-center action-btn">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($texts as $key => $txt)
                                <tr>
                                    <td>
                                        {{ $txt->key }}
                                    </td>

                                    <td>{{ $txt->value }}</td>

                                    <td class="text-center">
                                        <div class="actions">
                                            <a data-id="{{ $txt->id }}" data-name="{{ $txt->name }}"
                                               class="btn btn-sm btn-info editbtn" data-toggle="modal"
                                               href="javascript:void(0)">
                                                <i class="fe fe-pencil"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit_category" aria-hidden="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="background-color: white;color: black">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Content</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('admin/edit_home/'.$txt->id) }}">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row form-row">
                                                        <div class="col-12">
                                                            <input type="hidden" name="id" id="edit_id">
                                                            <div class="form-group">
                                                                <label>Content</label>
                                                                <input id="value_aya" value="{{old('value') ?? $txt->value }}" style="background-color: white" type="text" class="form-control edit_name" name="value">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add_categories" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" name="value" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /ADD Modal -->

    <!-- Edit Details Modal -->

@endsection


@section('js')

    <script>
        $(document).ready(function() {
            $('#category-table').on('click', '.editbtn', function() {
                // alert(1)
                event.preventDefault();
                $('#edit_category').modal('show');
                var id = $(this).data('id');
                var value = $(this).data('value');
                $('#value_aya').val(value);
                $('#edit_id').val(id);
                $('.edit_name').val(name);
            });
            //
        });
    </script>

@endsection
