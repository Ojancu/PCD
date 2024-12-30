@extends('layouts.master')

@section('main-content')
    <div class="container d-flex justify-content-center" style="margin-top: 100px">
        <div style="width: 500px">
            <h1 class="text-center">Background Replacement</h1>
            @if (isset($imageUrl))
                <img src="{{ $imageUrl }}" alt="image with BG">
            @else
                <p>No image found.</p>
            @endif
        </div>
    </div>
@endsection