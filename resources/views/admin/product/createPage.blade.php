@extends('admin.layouts.master')
@section('title', 'Product Create Page')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Product Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- product name --}}
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control  @error('name') is-invalid  @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="Enter category name with at least 5 minimum characters">

                                </div>
                                @error('name')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                                {{-- category name --}}
                                <div class="form-group">
                                    <label for="category_id">Category Name</label>
                                    <select name="category_id"
                                        class="form-control @error('category_id')
                                    is-invalid
                                    @enderror">
                                        <option>Select category...</option>
                                        @foreach ($cat as $c)
                                            <option value="{{ $c->id }}"
                                                @if (old('category_id') == $c->id) selected @endif>{{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror

                                {{-- description --}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Write description..."
                                        class="form-control  @error('description') is-invalid  @enderror">{{ old('description') }}</textarea>


                                </div>
                                @error('descrption')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                                {{-- image --}}
                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" name="image" id="name"
                                        class="form-control  @error('image') is-invalid  @enderror"
                                        placeholder="Enter category name with at least 5 minimum characters">

                                </div>
                                @error('image')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror


                                {{-- price --}}
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price"
                                        class="form-control  @error('price') is-invalid  @enderror"
                                        value="{{ old('price') }}" placeholder="Enter unit price ">

                                </div>
                                @error('price')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror

                                {{-- waiting day --}}
                                <div class="form-group">
                                    <label for="waiting_day">Waiting day</label>
                                    <input type="number" name="waiting_day" id="waiting_day"
                                        class="form-control  @error('waiting_day') is-invalid  @enderror"
                                        value="{{ old('waiting_day') }}" placeholder="Enter waiting day ">

                                </div>
                                @error('waiting_day')
                                    <div>
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror

                                {{-- stock --}}
                                <div class="form-group">
                                    <label for="stock">Stocks</label>
                                    <input type="number" name="stock" id="stock"
                                        class="form-control  @error('stock') is-invalid  @enderror"
                                        value="{{ old('stock') }}" placeholder="Enter stock units...  ">

                                </div>
                                @error('stock')
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
                                <a href="{{ route('product#listPage') }}" class="btn btn-secondary">Cancel</a>

                                <input type="submit" value="Create" class="btn btn-success float-right">

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
