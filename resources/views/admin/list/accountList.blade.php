@extends('admin.layouts.master')
@section('title', 'Account list page')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account lists</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Account Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">

                                    {{-- Search --}}

                                    <form action="{{ route('admin#listPage') }}" method="get" class=" d-flex ">
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
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->gender }}
                                        </td>
                                        <td>{{ $a->phone }}
                                        </td>
                                        <td>{{ $a->role }}</td>
                                        <td>{{ $a->created_at->format('d/m/Y') }}</td>



                                        @if (Auth::user()->id != $a->id)
                                        @if ($a->role == 'admin')
                                        <td> <a href="#">
                                                <input type="hidden" class="userId" value="{{ $a->id }}">

                                                <button class="btn btn-primary changeRoleUser">change
                                                    role</button>

                                            </a></td>
                                        @else
                                        <td> <a href="#">
                                                <input type="hidden" class="userId" value="{{ $a->id }}">

                                                <button class="btn btn-primary changeRole">change
                                                    role</button>

                                            </a></td>
                                        <td> <a href="#">
                                                <input type="hidden" class="userId" value="{{ $a->id }}">

                                                <button class="btn btn-danger deleteUser">Delete User
                                                </button>

                                            </a></td>
                                        @endif
                                        @endif



                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $admin->appends(request()->query())->links() }}
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

@section('scriptSource')
<script>
    $(document).ready(function() {
            $('.changeRole').click(function() {

                $userId = $('.userId').val();
                console.log($userId);
                $.ajax({
                    type: 'get',
                    url: '/ajax/changeRole',
                    data: {
                        'user_id': $userId,
                    },
                    datatype: 'json',

                })
                window.location.reload();

            })

            $('.changeRoleUser').click(function() {

            $userId = $('.userId').val();
            console.log($userId);
            $.ajax({
            type: 'get',
            url: '/ajax/changeRoleUser',
            data: {
            'user_id': $userId,
            },
            datatype: 'json',

            })
            window.location.reload();

            })

            $('.deleteUser').click(function() {

                $userId = $('.userId').val();
                console.log($userId);
                $.ajax({
                    type: 'get',
                    url: '/ajax/deleteUser',
                    data: {
                        'user_id': $userId,
                    },
                    datatype: 'json',

                })
                window.location.reload();

            })
        })
</script>

@endsection
@endsection
