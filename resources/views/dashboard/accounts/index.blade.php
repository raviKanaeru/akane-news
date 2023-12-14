@extends('dashboard.front.main')
@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if ($user->image)
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ url('img/user-icon/profile.png') }}" alt="User profile">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{ $user->username }}</h3>
                                @if ($user->is_admin == 1)
                                    <p class="text-muted text-center">Admin</p>
                                @else
                                    <p class="text-muted text-center">Author</p>
                                @endif


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>News</b> <a class="float-right">{{ $countNews }}</a>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between">
                                </div>
                                <button class="edit btn btn-warning btn-block" data-toggle="modal" data-target="#userModal"
                                    data-id="{{ $user->username }}"><b><i class='fas fa-pencil-alt'></i>
                                        Edit</b></button>
                                <button class="reset btn btn-success btn-block" data-toggle="modal" data-target="#userModal"
                                    data-id="{{ $user->username }}"><b><i class='fas fa-key'></i> Reset
                                        Password</b></button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-address-card mr-1"></i> Name</strong>

                                <p class="text-muted">
                                    {{ $user->name }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                                <p class="text-muted"> {{ $user->email }}</p>

                                <hr>

                                <strong><i class="fas fa-user-edit mr-1"></i> Updated at</strong>

                                <p class="text-muted">
                                    {{ date('l, d F Y h:i A', strtotime($user->updated_at)) }}

                                </p>

                                <hr>

                                <strong><i class="far fa-calendar-plus mr-1"></i> Created at</strong>

                                <p class="text-muted">{{ date('l, d F Y h:i A', strtotime($user->created_at)) }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
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

        // reset pass user / update user 
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
                        location.reload();
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
                    hide_error();
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
                    hide_error();
                    $('#targetUsername').val(data.username);
                },
                error: function(xhr, status, error) {
                    toastr.error('User not found!');
                }
            })
        });
        // reset form
        function reset() {
            $("#userForm")[0].reset();
            $("#userModal").modal('hide');
            $('.img-preview').attr('src', '');
            hide_error();
            $('.modal-title').text('Add User');
            $('#oldImage').removeAttr('value');
            $('#targetUsername').removeAttr('value');
            $('#save').text('Save');
            show_field_pass();
            show_field();
        }

        function hide_error() {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
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
    </script>
@endsection
