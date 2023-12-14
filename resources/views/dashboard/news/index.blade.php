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
                        <h1 class="m-0">Manage News</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">News</li>
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
                                <h3 class="card-title">News Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="/dashboard/news/create" class="btn btn-secondary mb-3">
                                        <i class="nav-icon fas fa-plus"></i>
                                        Add News
                                    </a>
                                    <button class="btn btn-secondary mb-3" id="reload-btn" data-toggle="tooltip"
                                        data-placement="top" title="Reload Table">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table id="data" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">No</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Status</th>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // view blogs
            $("#data")
                .DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                        url: "{{ route('dashboard.news.index') }}"
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
                            data: 'title',
                            name: 'title',
                            width: '30%'
                        },
                        {
                            data: 'category.name',
                            name: 'category',
                            width: '20%'
                        },
                        {
                            data: 'image',
                            name: 'image',

                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: '18%'
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

            // reload table
            function reload_table() {
                $('#data').DataTable().columns.adjust().draw();
                $('#data').DataTable().ajax.reload();
            }

            // delete form
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let aksi = confirm('Apakah anda yakin?');
                if (aksi === true) {
                    let slug = $(this).data('id');
                    let url = "{{ route('dashboard.news.delete', ['news' => ':slug']) }}";
                    url = url.replace(':slug', slug);
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            slug: slug,
                            '_method': "delete",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            reload_table();
                        },
                        error: function(xhr, status, error) {
                            toastr.error('News failed to deleted!');
                        }
                    });
                }
            });
        });
    </script>
@endsection
