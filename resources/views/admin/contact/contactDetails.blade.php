@extends('admin.layouts.master')
@section('Contact message')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div onclick="history.back()" class="ms-3 "><i class="fa-solid fa-arrow-left"></i></div>
            <div class="row">


                <div class="col-8 offset-2">


                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                {{-- <img class="profile-user-img img-fluid img-circle" src=""
                                    alt="User profile picture"> --}}
                                @if($c->user_image == null)
                                @if ($c->user_gender == 'male')
                                <img src="{{ asset('avatarimg/avatar_male.png') }}"
                                    class="profile-user-img img-fluid img-circle" alt="User profile picture" alt="">
                                @else
                                <img src="{{ asset('avatarimg/avatar_female.png') }}"
                                    class="profile-user-img img-fluid img-circle" alt="User profile picture" alt="">
                                @endif
                                @else
                                <img src="{{ asset('ProjectImg/' . $c->user_image) }}"
                                    class="profile-user-img img-fluid img-circle" style="width:100px; height:100px"
                                    alt="User profile picture" alt="">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $c->name }}</h3>

                            <p class="text-muted text-center">{{ $c->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $c->user_phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $c->user_address }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right">{{ $c->user_gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Message</b> <br /> <a class=""><textarea id="" cols="50"
                                            rows="10">{{ $c->message }}</textarea></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date</b> <br /> <a class="">{{$c->created_at->format('d/m/Y')}}</a>
                                </li>


                            </ul>


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