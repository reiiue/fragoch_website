@extends('layouts.app')

@section('content')
<h1 class="mb-4">Available Rooms</h1>

<div class="row">
@foreach($rooms as $room)
    <div class="col-md-4 mb-4">
        <div class="card">
            @if($room->images->first())
                <img src="{{ $room->images->first()->image_url }}" class="card-img-top" alt="">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $room->room_type }} - {{ $room->room_number }}</h5>
                <p>₱{{ number_format($room->base_price, 2) }} / night</p>
                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
