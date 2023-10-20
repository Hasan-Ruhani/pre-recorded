@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.PaymentMethodList')
    @include('component.CartList')
    @include('component.TopBrands')
    @include('component.Footer')
    <script>
        (async () => {
            await CartList();
            await TopBrands();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        })()
    </script>
@endsection





