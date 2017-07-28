@extends('layouts.main')

@section('title', 'Index')

@section('content')

    <h1>Order: {{ $model->id }}</h1>
    <p class="text-right">
        <a href="{{ route('admin.order.update', ['id' => $model->id]) }}" class="btn btn-primary">Update</a>
        <a href="{{ route('admin.order.delete', ['id' => $model->id]) }}" class="btn btn-danger" data-confirm="Are you sure?" data-method="post">Delete</a>
    </p>

    {!! \yii\widgets\DetailView::widget($detailViewConfig) !!}

    <h2>Order Items</h2>

    {!! \yii\grid\GridView::widget($gridViewConfig) !!}

@endsection
