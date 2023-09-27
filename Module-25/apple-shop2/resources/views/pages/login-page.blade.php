@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.Login')
    @include('component.TopBrands')
    @include('component.Footer')
    <script>
        (async () => {
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        })()
    </script>
@endsection

