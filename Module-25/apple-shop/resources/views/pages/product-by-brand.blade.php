@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.ByBrandList')
    @include('component.TopBrands')
    @include('component.Footer')
    <script>
        (async () => {
            await Category();
            await ByBrand();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await TopBrands();
        })()
    </script>
@endsection





