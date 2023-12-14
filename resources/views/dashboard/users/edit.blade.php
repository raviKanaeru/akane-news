@extends('dashboard.front.main')
@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Category</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
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
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="/dashboard/categories/{{ $category->slug }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="oldImage" value="{{ $category->image }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name Category</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Enter name" required value="{{ old('name', $category->name) }}"
                                                autofocus />
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug Category</label>
                                            <input type="text" name="slug"
                                                class="form-control @error('slug') is-invalid @enderror" id="slug"
                                                required value="{{ old('slug', $category->slug) }}" readonly />
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Category Thumbnail</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="image" name="image" accept="image/*">
                                                <label class="custom-file-label" for="name">Choose
                                                    file...</label>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-secondary float-right">
                                                Save changes
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </form>

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
    <script>
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
        });
    </script>
@endsection
