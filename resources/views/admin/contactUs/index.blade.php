@extends('layout.dashborad')
@section('name','Show Users')
@section('btn')
@endsection
@section('css')

@endsection
@section('content')
    <div class="col-lg-12 grid-margin">
        <div class="card" >
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Full Name</th>
                            <th> Message</th>
                            <th> Date</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @forEach($contacts as $contact)
                            <tr>
                              <td>{{ $contact->id }}</td>
                              <td>{{ $contact->contact->name }}</td>                                
                              <td class="text-wrap">{{ $contact->message }}<br></td>
                                <td class="text-wrap">{{ $contact->created_at }}</td>
                                    <td>
                                      <form method="POST" action="{{ route('admin.contactUs.destroy', ['msg' => $contact->id]) }}">
                                          @csrf
                                          <input name="_method" type="hidden" value="DELETE">
                                          <button type="submit" class="btn btn-danger btn-flat show_confirm rounded-0"
                                                  data-toggle="tooltip" title='Delete Product'><i class="mdi mdi-delete-forever"></i>
                                          </button>
                                      </form>
                                    </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
                <div class="align-self-center">{{ $contacts->links() }}</div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>
@endsection


