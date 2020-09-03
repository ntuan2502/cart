@extends('layouts.main')
@section('css')

@endsection

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('landing-page') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('shop.index') }}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if ($cart_count > 0)
                        <h3>{{ $cart_count }} item(s) in Shopping Cart</h3>
                        <div class="cart-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th class="p-name">Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th><i class="ti-close"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_content as $item)
                                        <tr>
                                            <td class="cart-pic first-row"><a
                                                    href="{{ route('shop.show', $item->model->slug) }}"><img
                                                        src="img/cart-page/product-1.jpg" alt=""></a>
                                            </td>
                                            <td class="cart-title first-row">
                                                <h5><a
                                                        href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                                </h5>
                                            </td>
                                            <td class="p-price first-row">{{ $item->vnd_price }}</td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" class="qty" value="{{ $item->qty }}"
                                                            data-id="{{ $item->rowId }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total-price first-row">
                                                {{ $item->vnd_subtotal }}</td>

                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <td class="close-td first-row"><button type="submit"><i
                                                            class="ti-close"></i></button></td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cart-buttons">
                                    <a href="{{ route('shop.index') }}" class="primary-btn continue-shop">Continue
                                        shopping</a>
                                    <a href="#" class="primary-btn up-cart">Update cart</a>
                                </div>
                                <div class="discount-coupon">
                                    <h6>Discount Codes</h6>
                                    @if (session()->get('coupon'))
                                        <form action="{{ route('coupon.destroy') }}" class="coupon-form" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="text" value="{{ session()->get('coupon')['name'] }}" readonly>
                                            <button type="submit" class="site-btn coupon-btn">Remove</button>
                                        </form>
                                    @else
                                        <form action="{{ route('coupon.store') }}" class="coupon-form" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" name="coupon_code" id="coupon_code"
                                                placeholder="Enter your codes">
                                            <button type="submit" class="site-btn coupon-btn">Apply</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="cart-total">Subtotal <span>{{ $cart_subtotal }}</span></li>
                                        @if (session()->get('coupon'))
                                            <li class="subtotal">Discount ({{ $coupon_name }})
                                                <span>{{ $discount }}</span>
                                            </li>
                                            <li class="cart-total">New Subtotal <span>{{ $cart_newSubtotal }}</span></li>
                                        @endif
                                        <li class="subtotal">Tax ({{ $cart_taxValue }}) <span>{{ $cart_newTax }}</span>
                                        </li>
                                        <li class="cart-total">Total <span>{{ $cart_newTotal }}</span></li>
                                    </ul>
                                    <a href="{{ route('checkout.index') }}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <h4>No items in Cart!</h4>
                        <div class="cart-buttons">
                            <a href="{{ route('shop.index') }}" class="primary-btn continue-shop">Continue shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        /*-------------------
                                                                              Quantity change
                                                                             --------------------- */
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }

            $button.parent().find('input').val(newVal);

            const id = $button.parent().find('input').attr('data-id');
            axios.patch(`/cart/${id}`, {
                    quantity: newVal,
                })
                .then(function(response) {
                    window.location.href = `{{ route('cart.index') }}`;
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        });

    </script>
@endsection
