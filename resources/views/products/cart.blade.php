@extends('layouts.app')

@section('content')



<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Cart</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                </div>

            </div>
        </div>
    </div>
</section>
<p class="container">
    @if(Session::has('delete'))
        <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('delete')}}</p>
    @endif
</p>
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table-dark" style="width:1100px;">
                        <thead class="thead-primary" style="background-color: #c49b63; height: 60px;">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cartProduct->count() > 0)
                            @foreach($cartProduct as $cartProduct)
                            <tr class="text-center">
                                
                                <td class="product-remove"><a href="{{ route('delete.product.cart', $cartProduct->pro_id) }}"><span class="icon-close"></span></a></td>

                                <td class="image-prod">
                                    <!-- <div class="img" style="background-image:url({{ asset('assets/images/'.$cartProduct->image.'')}});"></div> -->
                                    <img src="{{ asset('assets/images/'.$cartProduct->image.'')}}" alt="" style="width:100px; padding: 1rem;">
                                </td>

                                <td class="product-name">
                                    <h5>{{$cartProduct->name}}</h5>
                                    
                                </td>

                                <td class="price">${{$cartProduct->price}}</td>

                                <td>
                                    <div class="input-group mb-3">
                                        <input disabled type="text" name="quantity"
                                            class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>
                                <td class="total">${{$cartProduct->price}}</td>
                                <br>
                               
                                
                            </tr><!-- END TR-->
                            @endforeach
                            @else
                            
                                <p class="alert alert-dark"> You have no product in cart just yet. </p>
                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>$20.60</span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span>$0.00</span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span>$3.00</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>${{$totalCart}}</span>
                    </p>
                </div>
                @if ($cartProduct->count() > 0)
                <form method="post" action="{{ route('prepare.checkout')}}">
                    @csrf
                    <input type="hidden" name="price" value="{{$totalCart}}">
                    <button href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
                
                </form>
                
                @else
                <p class="text-center alert alert-warning"> You can not checkout this website
                </p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- 
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Related products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/menu-4.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


@endsection