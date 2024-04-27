@extends('admin.layouts.master')
@section('title', 'Low Stock Product list page')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Low Stock Product lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Low Stock Product lists</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>




    {{-- no need in dashboard only manage low stock items --}}
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

                                    {{-- no need in dashboard only manage low stock items --}}
                                    {{-- <form action="{{ route('product#listPage') }}" method="get" class=" d-flex ">
                                        <input type="text" name="key" class="form-control float-right"
                                            placeholder="Search" value="{{ request('key') }}">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                    </form> --}}


                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                @if (count($pro) == 0)
                                <h2 class="text-danger font-bold text-center m-2">There is no low stock item</h2>
                                @else
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>View Count</th>
                                        <th>Price</th>

                                        <th>Waiting time</th>
                                        <th>Stocks</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>

                                <tbody>


                                    @foreach ($pro as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td><img src="{{ asset('ProjectImg/' . $p->image) }}"
                                                style="width:50px; height:50px; " alt="">
                                        </td>
                                        <td>{{ $p->category_name }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td>{{ $p->view_count }}</td>
                                        <td>{{ $p->unit_price }}</td>
                                        <td>{{ $p->waiting_time }}</td>
                                        <td>{{ $p->stock }}</td>
                                        <td>{{ $p->created_at->format('d/m/Y') }}</td>

                                        <td> <a href="{{ route('dashboard#stockEditPage', $p->id) }}">


                                                <button class="btn btn-primary changeRole">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </button>

                                            </a></td>
                                        <td> <a href="{{ route('product#delete', $p->id) }}">


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
                                {{ $pro->appends(request()->query())->links() }}
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