@extends('admin.layouts.master')
@section('title', 'Order Details page')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Order Details lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div onclick="history.back()" class="ms-3"><i class="fa-solid fa-arrow-left"></i></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">OrderDetails Table</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                @if (count($order) == 0)
                                <h2 class="text-danger font-bold text-center m-2">There is no data</h2>
                                @else
                                <thead>
                                    <tr>
                                        <th>Order_code</th>

                                        <th>Customer</th>

                                        <th>Product</th>

                                        <th>Image</th>

                                        <th>Order Quantity</th>

                                        <th>Order unit price</th>


                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o)
                                    <tr>
                                        <td>{{ $o->order_code }}</td>

                                        <td>{{ $o->user_name }}</td>

                                        <td>{{ $o->product_name }}</td>

                                        <td><img src="{{ asset('ProjectImg/' . $o->product_image) }}"
                                                style="width:50px; height:50px; " alt="productimg">
                                        </td>

                                        <td>{{ $o->qty }}</td>

                                        <td>{{ $o->unit_price }}</td>

                                        <td>{{ $o->unit_price*$o->qty }}</td>

                                        <td>
                                            <select name="" id="">
                                                <option value="0" @if ($o->status == 0) selected @endif>pending
                                                </option>
                                                <option value="1" @if ($o->status == 1) selected @endif>success
                                                </option>
                                                <option value="1" @if ($o->status == 2) selected @endif>failed
                                                </option>



                                            </select>
                                        </td>
                                        <td>{{ $o->created_at->format('d/m/Y') }}</td>








                                        {{-- <td> <a href="{{ route('category#editPage', $c->id) }}">


                                                <button class="btn btn-primary changeRole">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </button>

                                            </a></td>
                                        <td> <a href="{{ route('category#delete', $c->id) }}">


                                                <button class="btn btn-danger deleteCategory">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                            </a></td> --}}





                                    </tr>
                                    @endforeach

                                </tbody>
                                @endif
                            </table>

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
