
@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.PolicyList')
    @include('component.TopBrands')
    @include('component.Footer')
    <script>
        (async () => {
            await Category();
            await Policy()
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await TopBrands();
        })()
    </script>
@endsection


