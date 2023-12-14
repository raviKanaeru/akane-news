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
                        <h1 class="m-0">Manage Users</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                <h3 class="card-title">Data Users</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="add-btn" class="btn btn-secondary mb-3" data-toggle="modal"
                                        data-target="#userModal">
                                        Add User
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
                                                <th>Username</th>
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


    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="targetUsername" id="targetUsername">
                        <input type="hidden" name="oldImage" id="oldImage">
                        <div class="form-group" id="name_form">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter name" required autofocus />
                            <div id="name_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group" id="username_form">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Enter username" required />
                            <div id="username_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group" id="email_form">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter email" required />
                            <div id="email_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group" id="password_form">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter password" required />
                            <div id="password_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group" id="password_confirm_form">
                            <label for="passwordconf">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Enter confirm password" required />
                            <div id="password_confirmation_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group" id="image_form">
                            <label for="image">Photo User (Optional)</label>
                            <img class="img-preview img-fluid mb-3 col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="image"
                                    name="image" />
                                <label class="custom-file-label" for="name">Choose
                                    file...</label>
                            </div>
                            <div id="image_error" class="invalid-feedback d-block"></div>
                        </div>

                    </form>
                    <div class="d-none" id="info-profil">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img id="image-profil" class="img-fluid rounded-circle profile-user-img" />
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <h5 id="name-profil"></h5>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <p class="text-muted" id="username-profil"></p>
                            </div>

                            <div class="col-12 d-flex justify-content-center">
                                <p class="font-weight-bold" id="subtitle-profil"></p>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <p class="font-weight-normal text-center" id="description-profil"></p>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <span class="font-weight-bold mr-1" id="subtitle-email"></span><a href="#"
                                    class="text-decoration-none" id="email-profil"></a>
                            </div>

                        </div>
                    </div>
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
                    url: "{{ route('dashboard.users.index') }}"
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
                        data: 'username',
                        name: 'username',
                        width: '30%'
                    },
                    {
                        data: 'status',
                        name: 'status',
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
            show_form();
        });

        // button reload
        $('#reload-btn').on('click', function() {
            reload_table();
            reset();
        });

        // update user / reset pass user / update user 
        $('#save').on('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('#userForm')[0]);
            let slug, urlAction, username;
            username = $('#targetUsername').val();
            urlAction = "{{ route('dashboard.users.update', ['user' => ':username']) }}";
            urlAction = urlAction.replace(':username', username);
            if ($(this).text() === 'Edit') {
                formData.append('_method', 'put');
                formData.append('target', 'update');
                formData.delete('password');
                formData.delete('password_confirmation');
            } else if ($(this).text() === 'Reset') {
                formData.append('_method', 'put');
                formData.append('target', 'reset');
                formData.delete('name');
                formData.delete('username');
                formData.delete('email');
                formData.delete('image');
                formData.delete('oldImage');
            } else {
                urlAction = "{{ route('dashboard.users.store') }}";
                formData.delete('targetUsername');
                formData.delete('oldImage');
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
                        console.log(response.data);
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
                        toastr.error('User failed to edited!');
                    } else if ($(this).text() === 'Reset') {
                        toastr.error('Password failed to reset!');
                    } else {
                        toastr.error('User failed to created!');
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
            $('.modal-title').text('Edit User');
            $('#save').text('Edit');

            let username = $(this).data('id');
            let editUrl = "{{ route('dashboard.users.edit', ['user' => ':username']) }}";
            editUrl = editUrl.replace(':username', username);
            $('#password_form').hide();
            $('#password_confirm_form').hide();
            show_field();
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
                    if (data.image != '') {
                        $('.img-preview').attr('src', "{{ asset('storage/') }}" + '/' +
                            data.image);
                        $('#oldImage').val(data.image);
                    } else {
                        $('.img-preview').attr('src', "{{ url('img/user-icon/profile.png') }}");
                        $('#oldImage').val(null);
                    };
                    show_form();
                    $('.img-preview').addClass('d-block');
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#targetUsername').val(data.username);
                },
                error: function(xhr, status, error) {
                    toastr.error('User not found!');
                }
            })
        });
        // reset view
        $(document).on('click', '.reset', function(e) {
            e.preventDefault();
            $('.modal-title').text('Reset Password User');
            $('#save').text('Reset');

            let username = $(this).data('id');
            let editUrl = "{{ route('dashboard.users.edit', ['user' => ':username']) }}";
            editUrl = editUrl.replace(':username', username);
            $('#name_form').hide();
            $('#username_form').hide();
            $('#email_form').hide();
            $('#image_form').hide();
            show_field_pass();
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
                    show_form();
                    $('#targetUsername').val(data.username);
                },
                error: function(xhr, status, error) {
                    toastr.error('User not found!');
                }
            })
        });

        // view profil
        $(document).on('click', '.show-card-profile', function(e) {
            e.preventDefault();
            $('.modal-title').text('Detail User');
            $('#save').text('Info');
            $('#save').attr('disabled', true);
            let username = $(this).data('id');
            let editUrl = "{{ route('dashboard.users.show', ['user' => ':username']) }}";
            editUrl = editUrl.replace(':username', username);

            show_field();
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
                    if (data.image != '') {
                        $('#image-profil').attr('src', "{{ asset('storage/') }}" + '/' +
                            data.image);
                    } else {
                        $('#image-profil').attr('src', "{{ url('img/user-icon/profile.png') }}");
                    };
                    let status = 'Admin';
                    if (data.is_admin === parseInt(0)) {
                        status = 'Author';
                    };
                    $('#userForm').hide();
                    $('#info-profil').removeClass('d-none');
                    $('#name-profil').text(data.name);
                    $('#username-profil').text(data.username);
                    $('#email-profil').text(data.email);
                    $('#subtitle-profil').text('Information');
                    $('#subtitle-email').text('Email : ');
                    $('#description-profil').text(
                        `Saya adalah seorang ${status} dengan nama ${data.name}. Aktivitas saya sebagai ${status} memungkinkan saya untuk mengekspresikan kreativitas dan imajinasi saya melalui tulisan-tulisan yang saya ciptakan. Jika Anda ingin menghubungi dengan saya atau berdiskusi lebih lanjut, silakan hubungi saya melalui email di ${data.email}. Saya selalu terbuka untuk berbagi pengalaman dan pengetahuan dengan rekan penulis dan pembaca.`
                    );

                },
                error: function(xhr, status, error) {
                    toastr.error('User not found!');
                }
            })
        });
        // delete form
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let aksi = confirm('Apakah anda yakin?');
            if (aksi === true) {
                let username = $(this).data('id');
                let url = "{{ route('dashboard.users.delete', ['user' => ':username']) }}";
                url = url.replace(':username', username);
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        username: username,
                        '_method': "delete",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        reload_table();
                    },
                    error: function(xhr, status, error) {
                        toastr.error('User failed to deleted!');
                    }
                });
            }
        });

        // reset form
        function reset() {
            $("#userForm")[0].reset();
            $("#userModal").modal('hide');
            $('.img-preview').attr('src', '');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('.modal-title').text('Add User');
            $('#oldImage').removeAttr('value');
            $('#targetUsername').removeAttr('value');
            $('#save').text('Save');
            show_field_pass();
            show_field();
            $('#userForm').show();
            $('#info-profil').addClass('d-none');
        }
        // reload table
        function reload_table() {
            $('#data').DataTable().columns.adjust().draw();
            $('#data').DataTable().ajax.reload();
        }

        function show_field() {
            $('#name_form').show();
            $('#username_form').show();
            $('#email_form').show();
            $('#image_form').show();
        }

        function show_field_pass() {
            $('#password_form').show();
            $('#password_confirm_form').show();
        }

        function show_form() {
            $('#userForm').show();
            $('#info-profil').addClass('d-none');
            $('#name-profil').text('');
            $('#username-profil').text('');
            $('#email-profil').text('');
            $('#description-profil').text('');
            $('#subtitle-profil').text('');
            $('#subtitle-email').text('');
            $('#image-profil').attr('src', '');
        }
    </script>
@endsection
