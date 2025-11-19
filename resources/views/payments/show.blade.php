@extends('layouts.app')

@section('content')
<h1>Payment for Booking #{{ $booking->id }}</h1>

<p>Total Amount: <strong>₱{{ number_format($booking->total_price, 2) }}</strong></p>

<form method="POST" action="{{ route('payment.store', $booking->id) }}">
    @csrf

    <div class="mb-3">
        <label>Payment Method</label>
        <select name="method" class="form-control" required>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Cash</option>
        </select>
    </div>

    <button class="btn btn-success">Pay Now</button>
</form>
@endsection
