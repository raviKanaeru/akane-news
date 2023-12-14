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
                        <h1 class="m-0">Show News</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/news">News</a></li>
                            <li class="breadcrumb-item active">show</li>
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
                                <h3 class="card-title">News Detail</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap justify-center">
                                    <div class="col-12">
                                        <h5 class="text-muted text-center">{{ $news->category->name }}</h5>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-center">{{ $news->title }}</h3>
                                    </div>
                                    <div class="col-12">
                                        <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                            alt="{{ $news->title }}">
                                    </div>

                                    <div class="col-12 mt-3">
                                        {!! $news->body !!}
                                    </div>
                                    <div class="col-12 mt-3 mb-2">
                                        <b>Author Choice </b> : <span
                                            class="text-muted">{{ $news->author_choice == 1 ? 'Recommended' : 'Not Recommended' }}</span>
                                    </div>
                                    <div class="col-12 mt-3 mb-5">
                                        <b>Status news </b> : <span
                                            class="text-muted">{{ $news->status_news == 0 ? 'Save a Draft' : 'Published' }}</span>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary" href="/dashboard/news">Back <i
                                                class="fas fa-arrow-left"></i></a>
                                    </div>
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
