@extends('layout.dashborad')
@section('name','Edit Category')

@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
						<div class="card-body col-12 col-lg-8 pe-3 pe-lg-5">
								<h4 class="card-title">Edit Category</h4>
										<div class="col row">
												<i class="mdi-plus"></i>
										</div>

								<form action="{{ route('admin.category.update', ['category' => $pages->id]) }}" method="POST">
										@csrf
                     @method('PUT')
										<div class="form-group">
												<input type="text" class="form-control" name="name_en" placeholder="Category Name" value="{{ $pages->name_en}}" required>
										</div>

										<div id="pages">
												@foreach($pages->data as $pKey => $page)
                        <div class="form-group">
																<div class="text-center position-relative p-2 pb-5" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;min-height: 200px;display: flex;align-items: center;flex-direction: column;" id="page_{{$pKey}}">
																		<input type="text" class="form-control mb-3" name="data[{{$pKey}}][title]" value="{{ $page['title'] }}" placeholder="Page Title" required />
																		<div class="form-group mb-3 w-100 flex-grow" id="page_{{$pKey}}_divs">
																				@foreach($page['divs'] as $dKey => $div)
																						<div class="text-center mb-3 px-2" style="border: 2px solid rgba(234,234,234,0.95);min-height: 100%;padding-top: 10px" id="page_{{$pKey}}_div_{{$dKey}}">
																								<input type="text" class="form-control mb-3" name="data[{{$pKey}}][divs][{{$dKey}}][title]" value="{{ $div['title'] }}" placeholder="Div Title" required />

																								<div id="page_{{$pKey}}_div_{{$dKey}}_fields">
																										@foreach($div['fields'] as $fKey => $field)
																												<div class="row mb-2" id="page_{{$pKey}}_div_{{$dKey}}_field_{{$fKey}}">
																														<input type="hidden" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][name]" value="{{ $field['name'] }}" required />
																														<div class="col-3">
																																<select title="type" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][type]" required >
																																		<option value="drop_list" @if($field['type'] === 'drop_list') selected @endif>drop_list</option>
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
																																<input title="placeholder" placeholder="placeholder" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][placeholder]" value="{{ $field['placeholder'] }}" required />
																														</div>
																														<div class="col-4">
																																<input title="hint" placeholder="hint" class="form-control" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][hint]" value="{{ $field['hint']??'' }}" />
																														</div>
                                                            <div class="col-1 d-flex p-0 m-0">
                                                              <div class="col" style="cursor: pointer" onclick="show_data(this)">
                                                                  <input type="hidden" name="data[{{$pKey}}][divs][{{$dKey}}][fields][{{$fKey}}][data]" value="{{ json_encode($field['data'], true)??'{}' }}" />
                                                                  <span class="fs-4 fw-bold"><i class="mdi mdi-file-document-edit-outline" style="color: deepskyblue"></i></span>
                                                              </div>
                                                              <div class="col" style="cursor: pointer" onclick="delete_field(this)">
                                                                  <span class="fs-4 fw-bold"><i class="mdi mdi-trash-can-outline" style="color: tomato"></i></span>
                                                              </div>
                                                            </div>
																												</div>
																										@endforeach
																								</div>
																								<div class="row mb-2">
																										<div class="d-flex align-items-center justify-content-center">
																												<span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
																												<span onclick="add_field({{$pKey}},{{$dKey}})" style="cursor: pointer">Add Field </span>
																										</div>
																								</div>
																						</div>
																				@endforeach
																		</div>
																		<div class="text-center  bottom-0 left-0 w-50 d-flex justify-content-evenly" onclick="add_div({{$pKey}})" style="cursor: pointer;border: 2px solid rgba(234,234,234,0.95);">
																				<div class="d-flex align-items-center justify-content-center">
																						<span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
																						<span>Add Div </span>
																				</div>
                                    </div>
                                    <div class="text-center  bottom-0 right-0 w-50 d-flex justify-content-evenly" onclick="remove_div({{$pKey}})" style="cursor: pointer;border: 2px solid rgba(234,234,234,0.95);">
                                      <div class="d-flex align-items-center justify-content-center text-danger">
                                          <span class="fs-2 fw-bold"><i class="mdi mdi-playlist-remove"></i></span>
                                          <span>Remove Div </span>
                                      </div>
                                    </div>
																</div>
														</div>
												@endforeach
										</div>

										<div class="form-group" onclick="add_page()" style="cursor: pointer">
												<div class="text-center" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;height: 200px;display: flex;justify-content: center;align-items: center;flex-direction: column;cursor: pointer;">
														<span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
														<span>Add Page </span>
												</div>
										</div>

										<button type="submit" class="btn btn-primary me-2" >Submit</button>
										<a class="btn btn-dark" href="{{route('admin.category.index')}}">Cancel</a>
								</form>
						</div>
				</div>
		</div>
</div>

@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        async function show_data(el) {
            let type = el.parentElement.parentElement.querySelector('select').value,
                data_el = el.querySelector('input[type=hidden]'),
                old_data = JSON.parse(data_el.value);
                // old_data = data_el.value;
                // old_data = data_el.value;
                // // Parse the old_data JSON string into an array
                //   const dataArray = JSON.parse(old_data);

                //   // Check if dataArray is an array, and if not, set it to an empty array
                //   const valuesArray = Array.isArray(dataArray) ? dataArray : [];
                console.log(old_data);

            let html = `<input type='hidden' value='${type}' id="swal_type" class="form-control" />`
            switch (type) {
                case 'drop_list':
                    html += `Options: <input type="text" title="comma separated list of items" value="${(old_data??[]).join(',')}"class="form-control" id="swal_drop_list_data" />`
                    break;
                // case 'drop_list':
                //     html += `Options: <input type="text" title="comma separated list of items" value="${old_data.join(',')}" class="form-control" id="swal_drop_list_data" />`
                //     break;
                case 'text':
                case 'textarea':
                case 'number':
                    html += `Min: <input type="number" class="form-control" value="${old_data.min??0}" id="swal_min" /><br />`
                    html += `Max: <input type="number" class="form-control" value="${old_data.max??0}" id="swal_max" />`
                    break;
                case 'date':
                    html += `Start: <input type="date" class="form-control" value="${old_data.start??''}" id="swal_data_start" /><br />`
                    html += `End: <input type="date" class="form-control" value="${old_data.end??''}" id="swal_data_end" />`
                    break;
                case 'table':
                    html += `Rows: <input type="text" title="comma separated list of items" value="${(old_data.rows??[]).join(',')}" class="form-control" id="swal_table_rows" /><br />`
                    html += `Columns: <input type="text" title="comma separated list of items" value="${(old_data.cols??[]).join(',')}" class="form-control" id="swal_table_cols" />`
                    break;
                default:
                    html += "<p>No Extra Data Specifications For This Type</p>"
                    break;
            }
            
            const {value: data} = await Swal.fire({
                title: '<label class="form-label">Specifications:</label>',
                html: html,
                background: 'rgba(27,31,47,0.94)',
                padding: '3px',
                confirmButtonText: 'Submit',
                confirmButtonColor: 'rgba(9,159,11,0.94)',
                focusConfirm: false,
                returnFocus: false,

                preConfirm: () => ({
                    type: $('#swal_type').val(),
                    start: $('#swal_date_start').val()??'',
                    end: $('#swal_date_end').val()??'',
                    min: $('#swal_min').val()??null,
                    max: $('#swal_max').val()??null,
                    rows: ($('#swal_table_rows').val()??'').split(','),
                    cols: ($('#swal_table_cols').val()??'').split(','),
                    drop_list_data: ($('#swal_drop_list_data').val()??'').split(','),
                })
            })
            if (data) {
                switch (data.type) {
                    case 'drop_list':
                        data_el.value = JSON.stringify(data.drop_list_data);
                        console.log(data_el.value);
                        break;
                    case 'text':
                    case 'textarea':
                    case 'number':
                        data_el.value = JSON.stringify({"min": data.min, "max": data.max});
                        break;
                    case 'date':
                        data_el.value = JSON.stringify({"start": data.start, "end": data.end});
                        break;
                    case 'table':
                        data_el.value = JSON.stringify({"rows": data.rows, "cols": data.cols});
                        break;
                    default:
                        data_el.value = JSON.stringify({});
                        break;
                }
            }
        }

        function genRandomString(length) {
            var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var result = '';
            for (let i=0;i<length;i++)
                result += chars.charAt(Math.floor(Math.random() * chars.length));

            return result;
        }

        function add_page() {
            let el = $('#pages'),
                pageNum = el.children().length,
                page = `
                <div class="form-group">
                    <div class="text-center position-relative p-2 pb-5" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;min-height: 200px;display: flex;align-items: center;flex-direction: column;" id="page_${pageNum}">
                        <input type="text" class="form-control mb-3" name="data[${pageNum}][title]" value="" placeholder="Page Title" required />

                        <div class="form-group mb-3 w-100 flex-grow" id="page_${pageNum}_divs"></div>
                        
                        <div class="text-center  bottom-0 left-0 w-50 d-flex justify-content-evenly" onclick="add_div(${pageNum})" style="cursor: pointer;border: 2px solid rgba(234,234,234,0.95);">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                                <span>Add Div </span>
                            </div>
                        </div>
                        <div class="text-center  bottom-0 right-0 w-50 d-flex justify-content-evenly" onclick="remove_div(${pageNum})" style="cursor: pointer;border: 2px solid rgba(234,234,234,0.95);">
                          <div class="d-flex align-items-center justify-content-center text-danger">
                              <span class="fs-2 fw-bold"><i class="mdi mdi-playlist-remove"></i></span>
                              <span>Remove Div </span>
                          </div>
                        </div>
                    </div>
                </div>`
            el.append(page);
        }
        function add_div(page) {
            let el = $('#page_'+page+'_divs'),
                divNum = el.children().length,
                div = `
                <div class="text-center mb-3 px-2" style="border: 2px solid rgba(234,234,234,0.95);min-height: 100%;padding-top: 10px" id="page_${page}_div_${divNum}">
                    <input type="text" class="form-control mb-3" name="data[${page}][divs][${divNum}][title]" value="" placeholder="Div Title" required />

                    <div id="page_${page}_div_${divNum}_fields"></div>
                    <div class="row mb-2">
                        <div class="d-flex align-items-center justify-content-center" onclick="add_field(${page},${divNum})" style="cursor: pointer">
                            <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                            <span>Add Field </span>
                        </div>
                    </div>
                </div>`;
            el.append(div);
        }
        function remove_div(page) {
          let el = $('#page_'+page+'_divs')
           el.children().last().remove();
        }
        function add_field(page, div) {
            let el = $('#page_'+page+'_div_'+div+'_fields'),
                fieldNum = el.children().length,
                field = `<div class="row mb-2" id="page_${page}_div_${div}_field_${fieldNum}">
                    <input type="hidden" name="data[${page}][divs][${div}][fields][${fieldNum}][name]" value="${genRandomString(10)}" />
                    <div class="col-3">
                        <select title="type" class="form-control" name="data[${page}][divs][${div}][fields][${fieldNum}][type]" required>
                            <option value="drop_list">drop_list</option>
                            <option value="subcategory">subcategory</option>
                            <option value="text">text</option>
                            <option value="url">url</option>
                            <option value="number">number</option>
                            <option value="date">date</option>
                            <option value="checkbox">checkbox</option>
                            <option value="y_n">y_n</option>
                            <option value="table">table</option>
                            <option value="links">links</option>
                            <option value="textarea">textarea</option>
                            <option value="assets">assets</option>
                            <option value="file">file</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input title="placeholder" placeholder="placeholder" class="form-control" name="data[${page}][divs][${div}][fields][${fieldNum}][placeholder]" value="" required />
                    </div>
                    <div class="col-4">
                        <input title="hint" placeholder="hint" class="form-control" name="data[${page}][divs][${div}][fields][${fieldNum}][hint]" value="" />
                    </div>
                    <div class="col" style="cursor: pointer" onclick="show_data(this)">
                        <input type="hidden" name="data[${page}][divs][${div}][fields][${fieldNum}][data]" value="[]" />
                        <span class="fs-2 fw-bold"><i class="mdi mdi-file-document-edit-outline" style="color: deepskyblue"></i></span>
                    </div>
                </div>`
            el.append(field);
        }

        function delete_field(el) {
          const fields = el.parentElement.parentElement
            fields.remove();
        }
    </script>
@endpush
