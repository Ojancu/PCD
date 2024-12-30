@extends('layouts.master')

@section ('main-content')
    <div class="container d-flex justify-content-center" style="margin-top: 100px">
        <div style="width: 500px">
            <h1 class="text-center">Background Removal</h1>
             <!-- Container input OBJECT-->
            <form action="{{ route('remove.bg') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="btn btn-outline-secondary" style="width: 100%;margin-top: 8px;" onclick="document.getElementById('file-object').click();">
                    <input type="file" id="file-object" name="image" accept="image/*" style="display: none;" onchange=
                        "
                        var selectedFile = document.getElementById('file-object').files[0];
                        var reader = new FileReader();

                        reader.onload = function(event) {
                        document.getElementById('image-preview').src = event.target.result;
                        };

                            reader.readAsDataURL(selectedFile);
                        "> 
                    <label for="" class="mb-0">Masukkan Gambar</label>
                </div>
                <!-- Container OBJECT-->
                <img id="image-preview" src="" style="display: none; width: 100%; height: 300px; object-fit: contain; margin-top: 25px;">
                <button type="submit" id="btn-remove" class="btn btn-success" style="display: none; margin-top: 10px;">Remove Background</button>
            
                <img id="result-image" src="" style="display: none; width: 100%; height: 300px; object-fit: contain; margin-top: 25px;">
            </form>
            @if($errors->any())
                <div>{{ $errors->first() }}</div>
            @endif
            <!-- Script -->
            <script>
                // Show
                document.getElementById('file-object').addEventListener('change', function() {
                    document.getElementById('image-preview').style.display = 'block';
                });

                document.getElementById('file-object').addEventListener('change', function() {
                    document.getElementById('btn-remove').style.display = 'block';
                });
            </script>
        </div>
    </div>
@endsection


