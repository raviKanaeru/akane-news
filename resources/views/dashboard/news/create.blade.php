@extends('dashboard.front.main')
@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create News</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Create News</li>
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
                                <h3 class="card-title">Create News</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="/dashboard/news" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">News Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror" id="title"
                                                placeholder="Enter title news" value="{{ old('title') }}" required />
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">News Slug</label>
                                            <input type="text" name="slug"
                                                class="form-control @error('slug') is-invalid @enderror" id="slug"
                                                value="{{ old('slug') }}" readonly required />
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category">News Category</label>
                                            <select class="form-control" id="category" name="category_id" required>
                                                <option disabled selected>-Pilih Category-</option>
                                                @foreach ($categories as $category)
                                                    @if (old('category_id') == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="author_choice">Author Choice</label>
                                            <select class="form-control" id="author_choice" name="author_choice" required>
                                                @foreach ($choices as $key => $choice)
                                                    @if (old('author_choice') == $key)
                                                        <option value="{{ $key }}" selected>{{ $choice['name'] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $choice['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('author_choice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="time">Time (Minute)</label>
                                            <input type="number" min="1" max="60" name="reading_time"
                                                class="form-control @error('reading_time') is-invalid @enderror"
                                                id="time" value="{{ old('reading_time') }}" required />
                                            @error('reading_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="thumbnail">News Thumbnail</label>
                                            <img class="img-preview img-fluid mb-3 col-sm-6">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image"
                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                        id="image" onchange="previewImage()" required />

                                                    <label class="custom-file-label" for="thumbnail">Choose file</label>

                                                </div>
                                            </div>
                                            <div class="input-group">
                                                @error('image')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="body">News Content</label>
                                            <textarea class="ckeditor" id="body" name="body" value="{{ old('body') }}" required>
                                                {{ old('body') }}
                                            </textarea>
                                            @error('body')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status_news">News Status</label>
                                            <select class="form-control" id="status_news" name="status_news" required>
                                                @foreach ($status as $key => $names)
                                                    @if (old('status_news') == $key)
                                                        <option value="{{ $key }}" selected>{{ $names['name'] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $names['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('status_news')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
            $('#title').on('change', function() {
                $.ajax({
                    url: '/dashboard/news/checkSlug',
                    data: {
                        title: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#slug').val(data.slug);
                    }
                });
            });


        });

        $(document).ready(function() {
            function previewImage() {
                const image = $('#image')[0];
                const imgPreview = $('.img-preview');

                imgPreview.css('display', 'block');

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFEvent) {
                    imgPreview.attr('src', oFEvent.target.result);
                };
            }

            $('#image').on('change', previewImage);
        });
    </script>
@endsection
