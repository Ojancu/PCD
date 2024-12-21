<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Background from Image</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">IMGEdit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">BG Removal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">BG Replacement</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container d-flex justify-content-center" style="margin-top: 100px">
        <div style="width: 500px">
            <h1 class="text-center">Background Replacement</h1>

            <div class="image-container d-flex justify-content-center align-items-center" style="border: 2px dashed #ccc; border-radius: 10px; padding: 10px; cursor: pointer; margin-top: 3px;">
                <input type="file" id="file-input" accept="image/*" style="display: none;"> 
                <label for="file-input" class="mb-0">Masukkan Gambar objek</label>
            </div>

            <div class="image-container d-flex justify-content-center align-items-center mt-4" style="border: 2px dashed #ccc; border-radius: 10px; padding: 10px; cursor: pointer;">
                <input type="file" id="file-background" accept="image/*" style="display: none;"> 
                <label for="file-background" class="mb-0">Masukkan Gambar Background</label>
            </div>
            
        </div>
    </div>

    
    <script src="script.js"></script>
</body>
</html>
