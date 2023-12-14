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
                        <h1 class="m-0">Manage Categories</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">Data Categories</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="add-btn" class="btn btn-secondary mb-3" data-toggle="modal"
                                        data-target="#categoryModal">
                                        Add Category
                                    </button>
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
                                                <th>Image</th>
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
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="targetSlug" id="targetSlug">
                        <input type="hidden" name="oldImage" id="oldImage">
                        <div class="form-group">
                            <label for="name">Name Category</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter name category" required autofocus />
                            <div id="name_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug Category</label>
                            <input type="text" name="slug" class="form-control" id="slug" required readonly />
                            <div id="slug_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="image">Category Thumbnail</label>
                            <img class="img-preview img-fluid mb-3 col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="image" name="image"
                                    required>
                                <label class="custom-file-label" for="name">Choose
                                    file...</label>
                            </div>
                            <div id="image_error" class="invalid-feedback d-block"></div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // add slug
        $(document).ready(function() {
            $('#name').on('change', function() {

                $.ajax({
                    url: '/dashboard/categories/checkSlug',
                    data: {
                        name: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#slug').val(data.slug);
                    }
                });
            });

            // change image
            $('#image').on('change', function() {
                const image = $('#image')[0];
                const imgPreview = $('.img-preview');

                imgPreview.css('display', 'block');

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFEvent) {
                    imgPreview.attr('src', oFEvent.target.result);
                };
            });

            // view categories
            $("#data")
                .DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                        url: "{{ route('dashboard.categories.index') }}"
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
                            data: 'image',
                            name: 'image',
                            width: '30%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: '30%'
                        },
                    ]
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            // button add
            $('#add-btn').on('click', function(e) {
                e.preventDefault();
                reset();
            });

            // button reload
            $('#reload-btn').on('click', function() {
                reload_table();
            });

            // add categories / update categories
            $('#save').on('click', function(e) {
                e.preventDefault();
                let formData = new FormData($('#categoryForm')[0]);
                let slug, urlAction;
                if ($(this).text() === 'Edit') {
                    slug = $('#targetSlug').val();
                    urlAction = "{{ route('dashboard.categories.update', ['category' => ':slug']) }}";
                    urlAction = urlAction.replace(':slug', slug);
                    formData.append('_method', 'put');
                } else {
                    urlAction = "{{ route('dashboard.categories.store') }}";
                }
                $.ajax({
                    url: urlAction,
                    method: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.success(response.message);
                            reload_table();
                            reset();
                        } else if (response.status == 422) {
                            $('.form-control').removeClass('is-invalid');
                            $('.invalid-feedback').text('');
                            printErrorMsg(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        if ($(this).text() === 'Edit') {
                            toastr.error('Category failed to Edited!');
                        } else {
                            toastr.error('Category failed to created!');
                        }
                    }
                });
            });

            // message validation form
            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    $('#' + key).addClass('is-invalid');
                    $('#' + key + '_error').text(value);
                })
            }

            // edit view
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('.modal-title').text('Edit Category');
                $('#save').text('Edit');

                let slug = $(this).data('id');
                let editUrl = "{{ route('dashboard.categories.edit', ['category' => ':slug']) }}";
                editUrl = editUrl.replace(':slug', slug);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: editUrl,
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $('.img-preview').attr('src', "{{ asset('storage/') }}" + '/' +
                            data.image);
                        $('.img-preview').addClass('d-block');
                        $('#name').val(data.name);
                        $('#slug').val(data.slug);
                        $('#oldImage').val(data.image);
                        $('#targetSlug').val(data.slug);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Category not found!');
                    }
                })
            });

            // delete form
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let aksi = confirm('Apakah anda yakin?');
                if (aksi === true) {
                    let slug = $(this).data('id');
                    let url = "{{ route('dashboard.categories.delete', ['category' => ':slug']) }}";
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
                            toastr.error('Category failed to deleted!');
                        }
                    });
                }
            });

            // reset form
            function reset() {
                $("#categoryForm")[0].reset();
                $("#categoryModal").modal('hide');
                $('.img-preview').attr('src', '');
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('.modal-title').text('Add Category');
                $('#oldImage').removeAttr('value');
                $('#targetSlug').removeAttr('value');
                $('#save').text('Save');
            }
            // reload table
            function reload_table() {
                $('#data').DataTable().columns.adjust().draw();
                $('#data').DataTable().ajax.reload();
            }
        });
    </script>
@endsection
