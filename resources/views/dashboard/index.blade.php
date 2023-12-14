@extends('dashboard.front.main')
@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $newsCount ?? 0 }}</h3>
                                <p>News</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="/dashboard/news" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $categoryCount ?? 0 }}</h3>

                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-grid"></i>
                            </div>
                            <a href="/dashboard/categories" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $userCount ?? 0 }}</h3>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-stalker"></i>
                            </div>
                            <a href="/dashboard/users" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $userFeedback ?? 0 }}</h3>

                                <p>Feedbacks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbubbles"></i>
                            </div>
                            <a href="/dashboard/feedbacks" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->

                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <h5 class="mb-2">Recent News</h5>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">News</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th style="width: 50%">News title</th>
                                            <th style="width: 10%">Category</th>
                                            <th>Reading Time</th>
                                            <th>Create At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentNews as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->reading_time }} Minute</td>
                                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </section>

                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
