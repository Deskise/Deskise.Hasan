@extends('layout.dashborad')
@section('name','Create New Category')

@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-12 col-lg-6 pe-3 pe-lg-5">
                    <h4 class="card-title">Add Category</h4>
                        <div class="col row">
                            <i class="mdi-plus"></i>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="name_en" placeholder="Category Name">
                        </div>

                    @foreach($pages as $pKey => $page)
                        <div class="form-group">
                            <div class="text-center position-relative p-2 pb-5" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;min-height: 200px;display: flex;align-items: center;flex-direction: column;">
                                <input type="text" class="form-control mb-3" name="data[{{$pKey}}][title]" value="{{ $page['title'] }}" placeholder="Page Title" />

                                <div class="form-group mb-3 w-100 flex-grow">
                                    @foreach($page['divs'] as $dKey => $div)
                                        <div class="text-center mb-3 px-2" style="border: 2px solid rgba(234,234,234,0.95);min-height: 100%;padding-top: 10px">
                                            <input type="text" class="form-control mb-3" name="data[{{$pKey}}][divs][{{$dKey}}][title]" value="{{ $div['title'] }}" placeholder="Div Title" />

                                            @foreach($div['fields'] as $fKey => $field)
                                                <div class="row mb-2">
                                                    <input type="hidden" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][name]" value="{{ $field['name'] }}" />
                                                    <div class="col-3">
                                                        <select title="type" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][type]">
                                                            <option value="drop_list" @if($field['type'] === 'drop_list') selected @endif>drop_list</option>
                                                            <option value="subcategory" @if($field['type'] === 'subcategory') selected @endif>subcategory</option>
                                                            <option value="text" @if($field['type'] === 'text') selected @endif>text</option>
                                                            <option value="url" @if($field['type'] === 'url') selected @endif>url</option>
                                                            <option value="number" @if($field['type'] === 'number') selected @endif>number</option>
                                                            <option value="date" @if($field['type'] === 'date') selected @endif>date</option>
                                                            <option value="checkbox" @if($field['type'] === 'checkbox') selected @endif>checkbox</option>
                                                            <option value="y_n" @if($field['type'] === 'y_n') selected @endif>y_n</option>
                                                            <option value="table" @if($field['type'] === 'table') selected @endif>table</option>
                                                            <option value="links" @if($field['type'] === 'links') selected @endif>links</option>
                                                            <option value="textarea" @if($field['type'] === 'textarea') selected @endif>textarea</option>
                                                            <option value="assets" @if($field['type'] === 'assets') selected @endif>assets</option>
                                                            <option value="file" @if($field['type'] === 'file') selected @endif>file</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <input title="placeholder" placeholder="placeholder" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][placeholder]" value="{{ $field['placeholder'] }}" />
                                                    </div>
                                                    <div class="col-4">
                                                        <input title="hint" placeholder="hint" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][hint]" value="{{ $field['hint']??'' }}" />
                                                    </div>
                                                    <div class="col" style="cursor: pointer">
                                                        <span class="fs-2 fw-bold"><i class="mdi mdi-file-document-edit-outline" style="color: deepskyblue"></i></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row mb-2">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                                                    <span onclick="">Add Field </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center position-absolute bottom-0 w-100" style="border: 2px solid rgba(234,234,234,0.95);">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                                        <span onclick="">Add Div </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <div class="form-group">
                                <div class="text-center" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;height: 200px;display: flex;justify-content: center;align-items: center;flex-direction: column;cursor: pointer;">
                                        <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                                        <span onclick="">Add Page </span>
                                </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2" >Submit</button>
                        <a class="btn btn-dark" href="#">Cancel</a>


                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        async function new_field() {
            let html = "<select name='category' id='cat_select' class='form-control' style='min-width=150%'></select>"

            const {value: el} = await Swal.fire({
                title: '<label class="form-label">Choose Field Type:</label>',
                html: html,
                background: 'rgba(27,31,47,0.94)',
                padding: '3px',
                confirmButtonText: 'Add URL',
                confirmButtonColor: 'rgba(9,159,11,0.94)',
                focusConfirm: false,
                returnFocus: false,

                preConfirm: () => ({
                    cat: $('#cat_select').val(),
                })
            })
            if (el)
                console.log(el);
        }
    </script>
@endpush
