@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search key : <span class="text-success">{{request('key')}}</span> </h4>
                        </div>
                    <div class="col-3 offset-9">
                        <form action="{{route('admin#orderList')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                            <button class="btn bg-dark text-white" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            </div>
                        </form>
                    </div>
                    </div>

                    {{-- <div class="row mt-2">
                        <div class="col-2 offset-10 text-primary p-2 text-right">
                            <h4> <i class="fa-solid fa-database mr-2"></i>{{ count($order) }}</h4>
                        </div>
                    </div> --}}

                        {{-- @csrf
                        <div class="d-flex">
                        <label for="" class="mt-1 me-4 mb-4">Order Status</label>


                    </div> --}}

                    <form action="{{ route('admin#changeStatus') }}" method="get" class="col-5">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"> <i class="fa-solid fa-database mr-2"></i>{{ count($order) }}</span>
                        </div>
                        <select name="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus')== '0') selected @endif>Pending</option>
                            <option value="1" @if (request('orderStatus')== '1') selected @endif>Accept</option>
                            <option value="2" @if (request('orderStatus')== '2') selected @endif>Reject</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm bg-dark text-white input-group-text"> <i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                        </div>

                    </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                    @if (count($order) != 0)
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td> {{ $o->user_id }} </td>
                                        <td> {{ $o->user_name }} </td>
                                        <td> {{ $o->created_at->format('j F Y') }} </td>
                                        <td>
                                            <a href="{{route('admin#listInfo',$o->order_code)}}" class="text-primary text-decoration-none">{{ $o->order_code }}</a>
                                        </td>
                                        <td> {{ $o->total_price }} Kyats</td>
                                        <td>
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                         @else
                        <h3 class="text-secondary text-center mt-5">There is no orders yet.</h3>
                        @endif
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
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     $.ajax({
            //         type: 'get',
            //         url: '/order/ajax/status',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {

            //                 $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            //                 // console.log(response[$i].created_at);
            //                 $dbDate = new Date(response[$i].created_at);
            //                 // console.log($months[$dbDate.getMonth()]+' '+ $dbDate.getDate() +' '+ $dbDate.getFullYear());
            //                 $finalDate = $months[$dbDate.getMonth()]+' '+ $dbDate.getDate() +' '+ $dbDate.getFullYear();

            //                 if(response[$i].status == 0){
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0" selected>
            //                                 Pending</option>
            //                             <option value="1">
            //                                 Accept</option>
            //                             <option value="2">
            //                                 Reject</option>
            //                         </select>
            //                     `;
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0">
            //                                 Pending</option>
            //                             <option value="1" selected>
            //                                 Accept</option>
            //                             <option value="2">
            //                                 Reject</option>
            //                         </select>
            //                     `;
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0">
            //                                 Pending</option>
            //                             <option value="1">
            //                                 Accept</option>
            //                             <option value="2" selected>
            //                                 Reject</option>
            //                         </select>
            //                     `;
            //                 }
            //                 $list += `
            //                         <tr class="tr-shadow">
            //                             <input type="hidden" class="orderId" value="${response[$i].id }">
            //                             <td> ${response[$i].user_id } </td>
            //                             <td> ${response[$i].user_name } || ${response[$i].id }</td>
            //                             <td> ${$finalDate} </td>
            //                             <td> ${response[$i].order_code } </td>
            //                             <td> ${response[$i].total_price } Kyats</td>
            //                             <td>
            //                                 ${$statusMessage}
            //                             </td>
            //                         </tr>
            //                         `;
            //             }
            //             // console.log('$list');
            //             $('#dataList').html($list);
            //         }
            //     })
            // })
            // change status
            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'orderId' : $orderId,
                    'status' : $currentStatus,
                }
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection
