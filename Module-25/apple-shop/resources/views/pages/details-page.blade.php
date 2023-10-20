@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.ProductDetails')
    @include('component.ProductSpecification')
    @include('component.TopBrands')
    @include('component.Footer')
    <script>
        (async () => {
            await productDetails();
            await productReview();
            await TopBrands();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        })()
    </script>
@endsection

