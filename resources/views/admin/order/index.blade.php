@extends('layouts.main')

@section('title', 'Index')

@section('content')

    <h1>Orders</h1>
    <div class="text-right">
        <a href="{{ route('admin.order.create') }}" class="btn btn-success">Create</a>
    </div>

    {!! \yii\grid\GridView::widget($gridViewConfig) !!}

@endsection
