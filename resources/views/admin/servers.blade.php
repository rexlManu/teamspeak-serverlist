@extends('admin.layouts.backend')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col block block-content block-fx-pop block-themed">

                <table class="table table-responsive table-striped" id="servers">
                    <thead>
                    <tr>
                        <th style="width: 100%">Name</th>
                        <th style="width: 10%"></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach(\App\Server::all() as $server)
                        <tr>
                            <td>{{ $server->serverUpdate()->data()[0]['name'] }}</td>
                            <td>
                                <button class="btn btn-hero-primary btn-hero-sm"
                                        onclick="deleteServer(this, {{ $server->id }})">Löschen
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const table = $('#servers').dataTable({
            "columns": [
                null,
                {
                    "sortable": false
                }
            ]
        });

        function deleteServer(row, server_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{ route('admin.servers.delete') }}',
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            server_id: server_id
                        },
                        success: () => {
                            Swal.fire(
                                'Deleted!',
                                'The server has been deleted.',
                                'success'
                            );
                            table.fnDeleteRow($(row).parents('tr'))
                        },
                        error: () => {
                            Swal.fire(
                                'Error!',
                                'The server could not be deleted.',
                                'error'
                            )
                        }
                    })
                }
            })
        }
    </script>
@endsection
