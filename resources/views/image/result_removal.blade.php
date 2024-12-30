@extends('layouts.master')

@section('main-content')
    <div class="container d-flex justify-content-center" style="margin-top: 100px">
        <div style="width: 500px">
            <h1 class="text-center">Background Removal</h1>

            <!-- Menampilkan gambar hasil pemrosesan background removal -->
            @if (isset($imageUrl))
                <div class="mb-4">
                    <img src="{{ $imageUrl }}" alt="Processed Image" class="img-fluid">
                </div>
            @else
                <p>No processed image found.</p>
            @endif

            <!-- Menampilkan gambar hasil deteksi tepi -->
            @if (isset($edgeImageUrl))
                <div class="text-center">
                    <h3>Edge Detection Result</h3>
                    <img src="{{ $edgeImageUrl }}" alt="Edge Detection" class="img-fluid">
                </div>
            @else
                <p>No edge detection image found.</p>
            @endif
        </div>
    </div>
@endsection
