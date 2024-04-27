@extends('admin.layouts.master')
@section('title', 'Category Create Page')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Category Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{ route('category#update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="category_id" value="{{ $c[0]['id'] }}">
                                </div>


                                <div class="form-group">

                                    <label for="name">Category Name</label>

                                    <input type="text" name="name" id="name"
                                        class="form-control  @error('name') is-invalid  @enderror"
                                        value="{{ old('name', $c[0]['name']) }}"
                                        placeholder="Enter category name with at least 5 minimum characters">

                                </div>
                                @error('name')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror



                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('category#listPage') }}" class="btn btn-secondary">Cancel</a>

                                <input type="submit" value="Update" class="btn btn-success float-right">

                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
