import sys
import cv2
import numpy as np

def remove_background(input_path, output_path, edge_output_path):
    # Load the image using OpenCV
    image = cv2.imread(input_path)
    if image is None:
        raise ValueError("Image not found. Please make sure the image path is correct.")

    # Resize for easier processing (optional)
    image = cv2.resize(image, (600, 400))

    # Convert to grayscale for edge detection
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Apply Canny edge detection with adjusted thresholds
    edges = cv2.Canny(gray, 50, 200)

    # Save the edge detection result
    cv2.imwrite(edge_output_path, edges)
    print(f"Edge detection result saved to: {edge_output_path}")

    # Create initial mask for GrabCut
    mask = np.zeros(image.shape[:2], np.uint8)

    # Define background and foreground models for GrabCut
    bg_model = np.zeros((1, 65), np.float64)
    fg_model = np.zeros((1, 65), np.float64)

    # Generate rectangle for initial segmentation
    height, width = image.shape[:2]
    rect = (50, 50, width - 100, height - 100)  # Adjusted rectangle closer to the center

    # Apply GrabCut algorithm to segment the image
    cv2.grabCut(image, mask, rect, bg_model, fg_model, 5, cv2.GC_INIT_WITH_RECT)

    # Convert mask to binary where 1 is foreground and 0 is background
    mask2 = np.where((mask == 2) | (mask == 0), 0, 1).astype('uint8')

    # Allow manual refinement of mask using edges
    mask[edges > 0] = cv2.GC_PR_FGD  # Mark edges as possible foreground

    # Apply GrabCut again with refined mask
    cv2.grabCut(image, mask, None, bg_model, fg_model, 5, cv2.GC_INIT_WITH_MASK)
    mask2 = np.where((mask == 2) | (mask == 0), 0, 1).astype('uint8')

    # Apply the mask to the image to keep only the foreground
    result = image * mask2[:, :, np.newaxis]

    # Convert result to BGRA (4 channels) to add alpha transparency
    result = cv2.cvtColor(result, cv2.COLOR_BGR2BGRA)

    # Set the alpha channel to 0 for transparent areas (background)
    result[:, :, 3] = mask2 * 255  # Set the alpha channel based on mask2

    # Save the processed image as PNG to retain transparency
    cv2.imwrite(output_path, result)
    print(f"Background removed successfully. Image saved to: {output_path}")

if __name__ == "__main__":
    if len(sys.argv) != 4:
        print("Usage: python bg_removal.py <input_path> <output_path> <edge_output_path>")
        sys.exit(1)

    input_path = sys.argv[1]
    output_path = sys.argv[2]
    edge_output_path = sys.argv[3]

    # Process the image
    remove_background(input_path, output_path, edge_output_path)
