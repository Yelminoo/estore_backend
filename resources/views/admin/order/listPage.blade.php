@extends('admin.layouts.master')
@section('title', 'Order list page')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Order lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order lists</li>
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
                            <h3 class="card-title">Order Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">

                                    {{-- Search --}}

                                    <form action="{{ route('order#listPage') }}" method="get" class=" d-flex ">
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
                            <div class="input-group row">
                                <div class="input-group-append btn  text-dark col-2 mt-2 border-2 border-dark">
                                    <span>Order total</span>
                                    <i class="fa-solid fa-clipboard-check mx-2 fa-2x"></i>
                                    {{ $order->count() }}
                                </div>
                                <form action="{{ route('order#filterList') }}" class="col-6 " method="get">
                                    @csrf
                                    <label for="status">Search Order via status</label>
                                    <select class="custom-select orderStatus form-control " id="inputGroupSelect04"
                                        name="status">
                                        <option value="">ALL</option>
                                        <option value="0" @if (request('status')=='0' ) selected @endif>Pending</option>
                                        <option value="1" @if (request('status')=='1' ) selected @endif>Success</option>
                                        <option value="2" @if (request('status')=='2' ) selected @endif>Reject</option>

                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                @if (count($order) == 0)
                                <h2 class="text-danger font-bold text-center m-2">There is no data</h2>
                                @else
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>

                                        <th>Order_code</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o)
                                    <tr>
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td><a href="{{ route('order#detailsPage',$o->order_code) }}">{{ $o->order_code
                                                }}</a></td>
                                        <td>{{ $o->total_price }}</td>
                                        <td>
                                            <select class="status">
                                                <option value="0" @if ($o->status == 0) selected @endif>pending
                                                </option>
                                                <option value="1" @if ($o->status == 1) selected @endif>success
                                                </option>
                                                <option value="2" @if ($o->status == 2) selected @endif>failed
                                                </option>



                                            </select>
                                        </td>
                                        <td>{{ $o->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                @endif
                            </table>
                            <div>
                                {{ $order->appends(request()->query())->links() }}
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


            $('.status').change(function() {
                $parentNode = $(this).parents('tr');
                $currentStatus = $(this).val();
                console.log($currentStatus);
                $orderId = $parentNode.find('.orderId').val();
                console.log($orderId);
                $.ajax({
                type: 'get',
                url: '/ajax/update/status',
                data: {
                'status': $currentStatus,
                'orderId': $orderId,

                },
                datatype: 'json',
                success: function(response) {
                var res=response;
                console.log(res);
                if (response.status == 'true') {
                console.log(response.status);
                window.location.reload();
                }
                }
                })
            })
        })
</script>

@endsection


@endsection