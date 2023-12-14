@extends('dashboard.front.main')
@section('container')
    <div class="content-wrapper">
        @if (session()->has('success'))
            <script>
                toastr.success('{{ session('success') }}');
            </script>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Feedback</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Feedback</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Feedback</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary mb-3" id="reload-btn" data-toggle="tooltip"
                                        data-placement="top" title="Reload Table">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table id="data" class="table table-bordered table-striped nowrap"
                                        style="width:100%">
                                        <thead class="head-table">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" disabled />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" disabled />
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea name="message" id="message" style="width: 100%" rows="5" disabled>

                        </textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // view feedback
            $("#data")
                .DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                        url: "{{ route('dashboard.feedback.index') }}"
                    },
                    columns: [{
                            // This column will display row numbers
                            data: null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                            width: '5%'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            width: '35%'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            width: '30%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: '10%'
                        },
                    ]
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            // button reload
            $('#reload-btn').on('click', function() {
                reload_table();
            });

            // view
            $(document).on('click', '.show-feedback', function(e) {
                e.preventDefault();
                $('#save').text('Edit');

                let id = $(this).data('id');
                let showUrl = "{{ route('dashboard.feedback.show', ['feedback' => ':id']) }}";
                showUrl = showUrl.replace(':id', id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: showUrl,
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#message').val(data.message);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Feedback not found!');
                    }
                })
            });

            // delete form
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let aksi = confirm('Apakah anda yakin?');
                if (aksi === true) {
                    let id = $(this).data('id');
                    let url = "{{ route('dashboard.feedback.delete', ['feedback' => ':id']) }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            '_method': "delete",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            reload_table();
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Feedback failed to deleted!');
                        }
                    });
                }
            });
            // reload table
            function reload_table() {
                $('#data').DataTable().columns.adjust().draw();
                $('#data').DataTable().ajax.reload();
            }
        });
    </script>
@endsection
