@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Sales</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($orders->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Recipe</th>
                    <th>Buyer</th>
                    <th>Date Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->recipe->title ?? 'Deleted Recipe' }}</td>
                    <td>{{ $order->buyer->name ?? 'Unknown' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No sales yet.</p>
    @endif
</div>
@endsection
