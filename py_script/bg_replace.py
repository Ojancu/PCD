import cv2
import numpy as np
import sys

def replace_background_with_alpha(image_path, background_path, output_path):
    # Baca gambar objek dan background
    foreground = cv2.imread(image_path, cv2.IMREAD_UNCHANGED)  # Membaca gambar dengan saluran alpha (transparansi)
    background = cv2.imread(background_path)

    if foreground is None:
        print("Gambar objek tidak ditemukan.")
        sys.exit()

    if background is None:
        print("Gambar background tidak ditemukan.")
        sys.exit()

    # Resize background agar sesuai dengan ukuran gambar objek
    height, width = foreground.shape[:2]
    background = cv2.resize(background, (width, height))

    # Pisahkan saluran alpha (transparansi) dari foreground
    alpha_channel = foreground[:, :, 3] / 255.0  # Normalisasi saluran alpha ke rentang [0, 1]
    
    # Ambil saluran BGR dari gambar foreground
    foreground_bgr = foreground[:, :, :3]

    # Gabungkan gambar dengan teknik alpha blending:
    # 1. Background bagian (1 - alpha) dan bagian foreground (alpha)
    background_blended = (background * (1 - alpha_channel[:, :, np.newaxis])).astype(np.uint8)
    foreground_blended = (foreground_bgr * alpha_channel[:, :, np.newaxis]).astype(np.uint8)

    # Gabungkan kedua gambar untuk mendapatkan hasil akhir
    final_image = cv2.add(background_blended, foreground_blended)

    # Simpan hasil gambar dengan latar belakang baru
    cv2.imwrite(output_path, final_image)
    print(f"Background berhasil diganti. Gambar disimpan di: {output_path}")

if __name__ == "__main__":
    # Mengambil path gambar objek, background, dan output dari argument
    image_path = sys.argv[1]
    background_path = sys.argv[2]
    output_path = sys.argv[3]

    replace_background_with_alpha(image_path, background_path, output_path)
