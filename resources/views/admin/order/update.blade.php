@extends('layouts.main')

@section('title', 'Update')

@section('content')

    <h1>Update Order: {{ $formModel->id }}</h1>

    @include('admin.order._form', ['formModel' => $formModel])

@endsection
