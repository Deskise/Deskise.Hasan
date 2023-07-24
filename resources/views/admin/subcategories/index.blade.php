@extends('layout.dashborad')
@section('name','Subcategories')

@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush

@section('content')
  @php
    $currentCategory = null;
  @endphp
  <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" >
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            {{-- <th> #</th> --}}
                            <th>Category</th>
                            <th>Sub-Categories</th>
                            <th>Add Categories</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                        @if(isset($category))
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="sub-row" data-category-id="{{ $category->id }}">
                                    @foreach ($category->subcategories as $subcategory)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex flex-column">
                                          <form action="{{route('admin.subcategories.update',$subcategory->id)}}" method="post" class="p-0 m-0">
                                          <p class="p-0 m-0 sub-name" data-subcategory-id="{{ $subcategory->id }}">{{ $subcategory->name_en }}</p>
                                          <input type="text" class="edit-name p-2 rounded" name="name_en" value="{{ $subcategory->name_en ?? '' }}" data-subcategory-id="{{ $subcategory->id }}" style="display: none;">
                                           @csrf
                                              @method('PUT')
                                              <button type="submit" class="btn btn-outline-success btn-flat save-btn" data-subcategory-id="{{ $subcategory->id }}" style="display: none;">Save</button>
                                            </form>
                                        </div>
                                        <div class="col-6 d-flex align-items-center">
                                          <form action="{{route('admin.subcategories.destroy',$subcategory->id)}}" method="post" class="p-0 m-0">
                                              @csrf
                                              @method('DELETE')
                                              <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">
                                              <button type="submit" class="btn mr-1"
                                                      data-toggle="tooltip" title='Delete Sub-Category'><i class="mdi mdi-trash-can-outline text-danger"></i>
                                              </button>
                                          </form>
                                          <div class="col-6 d-flex align-items-center">
                                            <button type="button" class="btn edit-btn" data-subcategory-id="{{ $subcategory->id }}">
                                              <i class="mdi mdi-pencil text-warning"></i>
                                            </button>
                                            
                                             
                                          </div>
                                        </div>
                                      </div>
                                      @endforeach
                                    {{-- <div>
                                      <input type="text" name="name_en" class="new-subcategory p-2 rounded sub-input" style="display: none;" data-category-id="{{ $category->id }}">
                                      <button type="submit" class="btn btn-outline-success text-center add-name" data-category-id="{{ $category->id }}" data-toggle="tooltip" title='Add Sub-Category' style="display: none;">
                                        <i class="mdi mdi-check-bold text-success"></i>
                                      </button>
                                    </div> --}}
                                  </td>
                                  <td>
                                    <div>
                                      <button type="button" class="btn mr-1 btn-outline-info text-center d-flex py-2  my-2 add-subcategory" data-category-id="{{ $category->id }}" data-toggle="tooltip" title='Add Sub-Category'>
                                        <i class="mdi mdi-plus text-info" ></i> Add New Subcategory
                                      </button>
                                      
                                      <form action="{{route('admin.subcategories.store',['category_id' => $category->id])}}" method="post" class="p-0 m-0">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                                        <input type="text" name="name_en" class="new-subcategory p-2 rounded sub-input" style="display: none;" data-category-id="{{ $category->id }}">
                                        <button type="submit" class="btn btn-outline-success text-center add-name" data-category-id="{{ $category->id }}" data-toggle="tooltip" title='Add Sub-Category' style="display: none;">
                                          <i class="mdi mdi-check-bold text-success"></i>
                                        </button>
                                      </form>
                                    </div>
                                </td>
                                </tr>
                                
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const addButtons = document.querySelectorAll('.add-subcategory');
        
        editButtons.forEach(function(editBtn) {
            const subcategoryId = editBtn.getAttribute('data-subcategory-id');
            const saveBtn = document.querySelector(`.save-btn[data-subcategory-id="${subcategoryId}"]`);
            const editNameInput = document.querySelector(`.edit-name[data-subcategory-id="${subcategoryId}"]`);
            const subName = document.querySelector(`.sub-name[data-subcategory-id="${subcategoryId}"]`);

            editBtn.addEventListener('click', function() {
                editBtn.style.display = 'none';
                editNameInput.style.display = 'inline-block';
                saveBtn.style.display = 'inline-block';
                subName.style.display = 'none';
            });
            saveBtn.addEventListener('click', function() {
              subName.style.display = 'inline-block';
              saveBtn.style.display = 'none';
              editBtn.style.display = 'inline-block';
              editNameInput.style.display = 'none';
            })
        });

        addButtons.forEach((addBtn) => {
          const categoryId = addBtn.getAttribute('data-category-id');
          const newSub = document.querySelector(`.new-subcategory[data-category-id="${categoryId}"]`);
          const addName = document.querySelector(`.add-name[data-category-id="${categoryId}"]`);
          const subRow = document.querySelector(`.sub-row[data-category-id="${categoryId}"]`);

          addBtn.addEventListener('click',() => {
            addName.style.display = 'inline-block';
            newSub.style.display = 'inline-block';
            addBtn.style.display = 'none';
          })
          addName.addEventListener('click', () => {
            addName.style.display = 'none';
            newSub.style.display = 'none';
            addBtn.style.display = 'inline-block';
          })
          addName.addEventListener('click', () => {
            let subInput = document.querySelector(`.sub-input[data-category-id="${categoryId}"]`).value;
            let newEntry = `
            <p class="p-0 m-0 sub-name" data-subcategory-id="${categoryId}">${subInput}</p>
            `
            subRow.insertAdjacentHTML('beforeend', newEntry);
          })
        })
    });
</script>

