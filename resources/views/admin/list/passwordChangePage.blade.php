@extends('admin.layouts.master')
@section('title', 'Password Change Page')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Change password</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            @if (session('oldPasswordError'))
                <div class="col-8 offset-2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('oldPasswordError') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- right column -->
                    <div class="col-md-8 offset-2">
                        <!-- Form Element sizes -->

                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Enter your old and new passwords</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('admin#passwordChange') }}" method="post">
                                    @csrf
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="col-form-label" for="oldPassword">
                                            Old Password</label>
                                        <input type="password" name='oldPassword'
                                            class="form-control @if (session('oldPasswordError')) is-invalid @endif "
                                            id="oldPassword" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="newPassword">
                                            New Password</label>
                                        <input type="password" name="newPassword"
                                            class="form-control @error('newPassword') is-invalid  @enderror"
                                            id="newPassword" placeholder="Enter ...">
                                    </div>
                                    @error('newPassword')
                                        <div>
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-form-label" for="confirmPassword">
                                            Confirm password</label>
                                        <input type="password" name="confirmPassword"
                                            class="form-control @error('confirmPassword') is-invalid @enderror"
                                            id="confirmPassword" placeholder="Enter ...">
                                    </div>
                                    @error('confirmPassword')
                                        <div>
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror

                                    <div>
                                        <button type="submit" class="btn btn-lg btn-primary">Change</button>
                                    </div>


                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
