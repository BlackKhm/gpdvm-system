{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/ktservice.css') }}" rel="stylesheet"> 

</head>
<body>

    @include('backpack.tkservices.partials.head')

    @include('backpack.tkservices.partials.navbar')

    @include('backpack.tkservices.partials.slide')

    @include('backpack.tkservices.partials.footer')
    
</body>
</html> --}}


@extends('backpack.layouts.app')

@section('content')
    @include('backpack.tkservices.partials.head')

    @include('backpack.tkservices.partials.navbar')

    @include('backpack.tkservices.partials.slide')

    @include('backpack.tkservices.partials.footer')
@endsection