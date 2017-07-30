@extends('layouts.main')

@section('title', 'Update')

@section('content')

    <h1>Update Order: {{ $form->model->id }}</h1>

    @include('admin.order._form', ['form' => $form])

@endsection
