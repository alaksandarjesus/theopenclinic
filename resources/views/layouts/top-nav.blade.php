@extends('layouts.layout')



@section('layout-content')

@include('components.navbar.primary')

@yield('content')

@endsection


@section('layout-page-templates')

@yield('page-templates')

@endsection