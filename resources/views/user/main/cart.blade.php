@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                                <th></th>
                            </tr>
                        </thead>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                {{-- <input type="hidden" name="" value="{{$c->pizza_price}}" id="pizzaPrice"> --}}
                                <td><img src="{{ asset('storage/' . $c->pizza_image) }}" class="img-thumbnail shadow-sm"
                                        alt="" style="width: 100px;"></td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }}
                                    <input class="orderId" type="hidden" value="{{ $c->id }}">
                                    <input class="productId" type="hidden" value="{{ $c->product_id }}">
                                    <input class="userId" type="hidden" value="{{ $c->user_id }}">
                                </td>
                                <td class="align-middle" id="pizzaPrice">{{ $c->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $c->qty }}" id="pizzaQty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" id="btnPlus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="pizzaTotal">{{ $c->pizza_price * $c->qty }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">500 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 500 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-dark font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // WHEN + BUTTON IS CLICKED
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#pizzaPrice').text().replace('Kyats', ''));
                $qty = Number($parentNode.find('#pizzaQty').val());

                $total = $price * $qty;
                $parentNode.find('#pizzaTotal').html($total + ' Kyats');

                summaryCaculation();
            })
            // WHEN - BUTTON IS CLICKED
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#pizzaPrice').text().replace('Kyats', ''));
                $qty = Number($parentNode.find('#pizzaQty').val());

                $total = $price * $qty;
                $parentNode.find('#pizzaTotal').html($total + ' Kyats');

                summaryCaculation();
            })
            // caculate final price for order
            function summaryCaculation() {
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#pizzaTotal').text().replace('Kyats', ''));
                })
                $('#subTotalPrice').html(`${$totalPrice} Kyats`);
                $('#finalPrice').html(`${$totalPrice+500} Kyats`);
            }
        })
    </script>
    <script>
        $('#orderBtn').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 10000001);
            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#pizzaQty').val(),
                    'total': $(row).find('#pizzaTotal').text().replace('Kyats', '') * 1,
                    'order_code': 'POS' + $(row).find('.userId').val() + $random
                })
            });
            $.ajax({
                type: 'get',
                url: '/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true') {
                        window.location.href = '/user/homePage';
                    }
                }
            })
        })
        // when clear button is clicked
        $('#clearBtn').click(function(){
            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/cart',
                dataType: 'json'
            })

            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html('0 Kyats');
            $('#finalPrice').html('500 Kyats');
        })
        // remove current product

            // WHEN x BUTTON IS CLICKED
            $('.btnRemove').click(function() {
                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('.productId').val();
                $orderId = $parentNode.find('.orderId').val();
                $.ajax({
                type: 'get',
                url: '/user/ajax/clear/current/product',
                data: {'productId':$productId , 'orderId':$orderId},
                dataType: 'json'
            })
                $parentNode.remove();
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#pizzaTotal').text().replace('Kyats', ''));
                })
                $('#subTotalPrice').html(`${$totalPrice} Kyats`);
                $('#finalPrice').html(`${$totalPrice+500} Kyats`);
            })
    </script>
@endsection
