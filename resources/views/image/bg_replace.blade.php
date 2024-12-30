@extends('layouts.master')

@section ('main-content')
    <div class="container d-flex justify-content-center" style="margin-top: 100px">
        <div style="width: 500px">
            <h1 class="text-center">Background Replacement</h1>
            
            <!-- Form untuk mengunggah gambar objek dan background-->
            <form action="{{ route('replace.bg') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Input untuk gambar objek -->
                <div class="btn btn-outline-secondary" style="width: 100%; margin-top: 8px;" onclick="document.getElementById('file-object').click();">
                    <input type="file" id="file-object" name="image" accept="image/*" style="display: none;" onchange="
                        var selectedFile = document.getElementById('file-object').files[0];
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            document.getElementById('image-preview').src = event.target.result;
                            document.getElementById('image-preview').style.display = 'block';
                            checkFilesReady();
                        };

                        reader.readAsDataURL(selectedFile);
                    "> 
                    <label for="" class="mb-0">Masukkan Gambar Objek</label>
                </div>
                <!-- Preview gambar objek -->
                <img id="image-preview" src="" style="display: none; width: 100%; height: 300px; object-fit: contain; margin-top: 25px;">
            
                <!-- Input untuk gambar background -->
                <div class="btn btn-outline-secondary" style="width: 100%; margin-top: 8px;" onclick="document.getElementById('file-background').click();">
                    <input type="file" id="file-background" name="background" accept="image/*" style="display: none;" onchange="
                        var selectedFile = document.getElementById('file-background').files[0];
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            document.getElementById('background-preview').src = event.target.result;
                            document.getElementById('background-preview').style.display = 'block';
                            checkFilesReady();
                        };

                        reader.readAsDataURL(selectedFile);
                    "> 
                    <label for="" class="mb-0">Masukkan Gambar Background</label>
                </div>
                <!-- Preview gambar background -->
                <img id="background-preview" src="" style="display: none; width: 100%; height: 300px; object-fit: contain; margin-top: 25px;">
                
                <!-- Tombol untuk mengganti background (hanya muncul setelah kedua gambar dipilih) -->
                <button type="submit" id="btn-replace" class="btn btn-primary" style="display: none; margin-top: 10px;">Ganti Background</button>
            
                <!-- Menampilkan hasil penggantian background -->
                <img id="result-image" src="" style="display: none; width: 100%; height: 300px; object-fit: contain; margin-top: 25px;">
            </form>
            
            @if($errors->any())
                <div>{{ $errors->first() }}</div>
            @endif

            <script>
                // Memeriksa apakah kedua gambar sudah diunggah, dan jika sudah, menampilkan tombol "Ganti Background"
                function checkFilesReady() {
                    const objectImage = document.getElementById('image-preview').src;
                    const backgroundImage = document.getElementById('background-preview').src;

                    // Menampilkan tombol "Ganti Background" hanya jika kedua gambar sudah ada
                    if (objectImage && backgroundImage) {
                        document.getElementById('btn-replace').style.display = 'block';
                    }
                }

                // Event listener untuk mengatur tampilan gambar objek dan background
                document.getElementById('file-object').addEventListener('change', function() {
                    document.getElementById('image-preview').style.display = 'block';
                    checkFilesReady();
                });

                document.getElementById('file-background').addEventListener('change', function() {
                    document.getElementById('background-preview').style.display = 'block';
                    checkFilesReady();
                });
            </script>
        </div>
    </div>
@endsection
