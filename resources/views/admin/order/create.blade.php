@extends('layouts.main')

@section('title', 'Create')

@section('content')

    <h1>Create Order</h1>

    @include('admin.order._form', ['form' => $form])

@endsection
