@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div class="table-responsive table-responsive-data2">

                        <a href="{{route('admin#orderList')}}" class="text-dark text-decoration-none">
                            <i class="fa-solid fa-arrow-left-long me-2"></i>Back
                        </a>
                        <div class="row col-6">
                            <div class="card mt-4">
                            <div class="card-body">
                                <h3><i class="fa-solid fa-book me-2"></i>Order Info </h3>
                                <small class="text-danger"><i class="fa-solid fa-exclamation"></i> Including delivery charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i> Name</div>
                                    <div class="col"> {{strtoupper($orderList[0]->user_name)}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                    <div class="col"> {{$orderList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-calendar me-2"></i> Order Date</div>
                                    <div class="col"> {{$orderList[0]->created_at->format('j F Y')}} </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-dollar-sign me-2"></i> Total</div>
                                    <div class="col"> {{$order->total_price}} Kyats</div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td> {{ $o->id }} </td>
                                        <td class="col-2"> <img src=" {{ asset('storage/'.$o->product_image) }} " class="img-thumbnail shadow-sm"> </td>
                                        <td> {{ $o->product_name }} </td>
                                        <td> {{ $o->created_at->format('j F Y') }} </td>
                                        <td> {{ $o->qty }} </td>
                                        <td> {{ $o->total }} </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $order->links() }} --}}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
