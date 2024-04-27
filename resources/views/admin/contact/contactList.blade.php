@extends('admin.layouts.master')
@section('title', 'Contact list page')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Contact lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product lists</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    {{-- go to create page --}}
    {{-- <div class="row mb-3">
        <div class="col-2 offset-10">
            <a href="{{ route('product#createPage') }}" class="d-flex justify-content-center">
                <button class="btn btn-success">
                    <i class="fa-solid fa-circle-plus mr-4"></i>
                    Add

                </button>
            </a>
        </div>
    </div> --}}

    {{-- create alert --}}
    {{-- <div class="row">
        @if (session('createSuccess'))
        <div class="col-4 offset-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('createSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div> --}}

    {{-- update alert --}}
    <div class="row">
        @if (session('updateSuccess'))
        <div class="col-6 offset-6">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{ session('updateSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div>

    {{-- delete alert --}}
    <div class="row">
        @if (session('deleteSuccess'))
        <div class="col-4 offset-8">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('deleteSuccess') }}</strong>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">

                                    {{-- Search --}}

                                    <form action="{{ route('contact#listPage') }}" method="get" class=" d-flex ">
                                        <input type="text" name="key" class="form-control float-right"
                                            placeholder="Search" value="{{ request('key') }}">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                @if (count($contact) == 0)
                                <h2 class="text-danger font-bold text-center m-2">There is no data</h2>
                                @else
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>

                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Gender</th>

                                        <th>Message</th>
                                        <th>Date</th>


                                    </tr>
                                </thead>

                                <tbody>


                                    @foreach ($contact as $c)
                                    <tr>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>
                                            @if ($c->user_image == null)
                                            @if ($c->user_gender == 'male')
                                            <img src="{{ asset('avatarimg/avatar_male.png') }}"
                                                class="profile-user-img  " alt="User profile picture"
                                                style="width:50px; height:50px;">
                                            @else
                                            <img src=" {{ asset('avatarimg/avatar_female.png') }}"
                                                class="profile-user-img  " alt="User profile picture"
                                                style="width:50px; height:50px;">
                                            @endif
                                            @else
                                            <img src=" {{ asset('ProjectImg/' . $c->user_image) }}"
                                                class="profile-user-img " alt="User profile picture" style="width:50px;
                                            height:50px;">
                                            @endif
                                        </td>
                                        <td>{{ $c->user_address }}</td>
                                        <td>{{ $c->user_phone }}</td>
                                        <td>{{ $c->user_gender }}</td>
                                        <td><textarea style="overflow: hidden" cols="10"
                                                rows="1">{{ $c->message }}</textarea>
                                        </td>
                                        <td>{{ $c->created_at->format('d/m/Y') }}</td>


                                        <td> <a href="{{ route('contact#detailsPage', $c->id) }}">


                                                <button class="btn btn-primary changeRole">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </button>

                                            </a></td>
                                        <td> <a href="{{ route('contact#delete', $c->id) }}">


                                                <button class="btn btn-danger deleteCategory">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                            </a></td>





                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif

                            </table>
                            <div>
                                {{ $contact->appends(request()->query())->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@endsection