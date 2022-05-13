@extends('admin.content')

@section('title') Edit gallery on product @endsection

@section('content')
    @include('admin.galleries.form', compact('product'))
@endsection
