<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ImageController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function removeBg(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('uploads', $filename, 'public');

        // Path ke file yang diunggah
        $uploadedImagePath = storage_path('app/public/' . $path);

        // Path untuk hasil gambar yang telah diproses
        $processedImagePath = storage_path('app/public/processed-images/' . pathinfo($filename, PATHINFO_FILENAME) . '.png');

        // Path untuk hasil edge detection
        $edgeOutputPath = storage_path('app/public/processed-images/' . pathinfo($filename, PATHINFO_FILENAME) . '_edges.png');

        // Path ke script Python Anda
        $scriptPath = base_path('py_script/bg_removal.py');

        // Jalankan script Python untuk memproses gambar dan hasil edge detection
        $process = new Process(['python', $scriptPath, $uploadedImagePath, $processedImagePath, $edgeOutputPath]);
        $process->run();

        // Periksa apakah proses berhasil
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Buat URL untuk hasil gambar yang telah diproses dan hasil deteksi tepi
        $imageUrl = Storage::disk('local')->url('processed-images/' . pathinfo($filename, PATHINFO_FILENAME) . '.png');
        $edgeImageUrl = Storage::disk('local')->url('processed-images/' . pathinfo($filename, PATHINFO_FILENAME) . '_edges.png');

        return view('image.result_removal', ['imageUrl' => $imageUrl, 'edgeImageUrl' => $edgeImageUrl]);
    }


    public function replaceBg(Request $request)
        {
            // Validasi permintaan
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'background' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Ambil gambar objek dan background yang diunggah
        $image = $request->file('image');
        $background = $request->file('background');

        // Buat nama file unik untuk gambar objek dan background
        $imageFilename = time() . '_image.' . $image->getClientOriginalExtension();
        $backgroundFilename = time() . '_background.' . $background->getClientOriginalExtension();

        // Tentukan path penyimpanan
        $imagePath = $image->storeAs('uploads', $imageFilename, 'public');
        $backgroundPath = $background->storeAs('uploads', $backgroundFilename, 'public');

        // Path ke file yang diunggah
        $uploadedImagePath = storage_path('app/public/' . $imagePath);
        $uploadedBackgroundPath = storage_path('app/public/' . $backgroundPath);

        // Path untuk hasil gambar yang telah diproses
        $processedImagePath = storage_path('app/public/processed-images/' . pathinfo($imageFilename, PATHINFO_FILENAME) . '_result.png');

        // Path to your Python script for background replacement
        $scriptPath = base_path('py_script/bg_replace.py');

        // Jalankan script Python untuk mengganti latar belakang
        $process = new Process([
            'python', 
            $scriptPath, 
            $uploadedImagePath, 
            $uploadedBackgroundPath, 
            $processedImagePath
        ]);
        $process->run();

        // Periksa apakah proses berhasil
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Buat URL untuk gambar yang sudah diproses
        $imageUrl = Storage::disk('local')->url('processed-images/' . pathinfo($imageFilename, PATHINFO_FILENAME) . '_result.png');

        // Tampilkan hasil gambar penggantian latar belakang
        return view('image.result_replacement', ['imageUrl' => $imageUrl]);
    }

}


    