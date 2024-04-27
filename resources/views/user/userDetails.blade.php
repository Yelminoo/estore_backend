@extends('admin.layouts.master')
@section('title', 'User Account Details')
@section('content')
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">

            @if (Auth::user()->role == 'user')
                <div class="col-8 offset-2">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Users dont have access to other than their own account details and edit.</strong><br>
                        <strong>Please make sure to adjust your account to your needs and then log out & go back to main
                            website.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            @if (session('updateSuccess'))
                <div class="col-8 offset-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
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


                    <div class="col-8 offset-2">


                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    {{-- <img class="profile-user-img img-fluid img-circle" src=""
                                        alt="User profile picture"> --}}
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('avatarimg/avatar_male.png') }}"
                                                class="profile-user-img img-fluid img-circle" alt="User profile picture"
                                                alt="">
                                        @else
                                            <img src="{{ asset('avatarimg/avatar_female.png') }}"
                                                class="profile-user-img img-fluid img-circle" alt="User profile picture"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('ProjectImg/' . Auth::user()->image) }}"
                                            class="profile-user-img img-fluid img-circle" style="width:100px; height:100px"
                                            alt="User profile picture" alt="">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Phone</b> <a class="float-right">{{ Auth::user()->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Address</b> <a class="float-right">{{ Auth::user()->address }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="float-right">{{ Auth::user()->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Role</b> <a class="float-right">{{ Auth::user()->role }}</a>
                                    </li>

                                </ul>

                                <a href="{{ route('user#editPage') }}" class="btn btn-primary btn-block"><b>Edit</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
