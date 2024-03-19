@extends('layouts.app')

@section('content')



<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg')}});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Product
                            Detail</span></p>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="container">
    @if(Session::has('succeess'))
        <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{ Session::get('success')}}</p>
    @endif
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{ asset('assets/images/'.$product->image.'')}}" class="image-popup"><img
                        src="{{ asset('assets/images/'.$product->image.'')}}" class="img-fluid"
                        alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3 class="text-white">{{$product->name}}</h3>
                <p class="price"><span>{{$product->price}}</span></p>
                <p>{{$product->description}}</p>
                <br>
                <br>
                <form action="{{route('add.Cart', $product->id)}}" method="post" enctype="multipart/form">
                    @csrf

                    <input type="hidden" name="pro_id" value="{{$product->id}}">
                    <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="hidden" name="image" value="{{$product->image}}">
                    @if($countCart == 0)
                    <button type="submit" name="submit" class="text-white btn btn-primary py-3 px-5">Add to
                        Cart</button>
                    @else
                    <button type="submit" name="submit" class=" btn py-3 px-5 btn-dark" disabled>Add to Cart</button>
                    @endif
                </form>

            </div>
        </div>
    </div>
</section>

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
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="{{ route('product.single', $relatedProduct->id) }}" class="img"
                        style="background-image: url({{ asset('assets/images/'.$relatedProduct->image.'')}});"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="{{ route('product.single', $relatedProduct->id) }}">{{$relatedProduct->name}}</a>
                        </h3>
                        <p>{{ $relatedProduct->description}}</p>
                        <p class="price"><span>${{ $relatedProduct->price }}</span></p>

                        @if($countCart == 0)
                        <p><button class="btn btn-primary btn-outline-primary" disabled="disabled">Add to Cart</a></p>
                        @else 
                        <p><a href="{{ route('product.single', $relatedProduct->id)}}"
                                class="btn btn-primary btn-outline-primary text-white">Add to Cart</a></p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>





@endsection