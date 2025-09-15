@extends('layouts.app2')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        margin: 80px 0 40px;
        text-align: center;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .product-info {
        background: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .product-row {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .product-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .product-details h3 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .product-meta {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: bold;
        color: #007bff;
    }

    .review-form {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 15px;
    }

    .required {
        color: #dc3545;
    }

    .rating-input {
        display: flex;
        gap: 5px;
        margin-bottom: 10px;
    }

    .star {
        font-size: 32px;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s ease;
        user-select: none;
    }

    .star:hover,
    .star.active {
        color: #ffc107;
    }

    .rating-label {
        font-size: 14px;
        color: #6c757d;
        margin-top: 5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e1e5e9;
        border-radius: 10px;
        font-size: 14px;
        transition: border-color 0.3s ease;
        resize: vertical;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #007bff;
    }

    .checkbox-label {
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }

    .file-upload {
        border: 2px dashed #ddd;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        transition: border-color 0.3s ease;
        cursor: pointer;
    }

    .file-upload:hover {
        border-color: #007bff;
        background: #f8f9ff;
    }

    .file-upload input[type="file"] {
        display: none;
    }

    .upload-icon {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 15px;
    }

    .upload-text {
        color: #6c757d;
        margin-bottom: 10px;
    }

    .upload-hint {
        font-size: 12px;
        color: #999;
    }

    .image-preview {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .preview-item {
        position: relative;
        width: 80px;
        height: 80px;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e1e5e9;
    }

    .remove-image {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e1e5e9;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #545b62;
        color: white;
        text-decoration: none;
    }

    .order-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .order-info strong {
        color: #333;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .product-row {
            flex-direction: column;
            text-align: center;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">Write a Review</h1>
        <p class="page-subtitle">Share your experience with this product</p>
    </div>

    <!-- Product Info -->
    <div class="product-info">
        <div class="product-row">
            @if($orderItem->product && $orderItem->product->images->isNotEmpty())
                <img src="{{ asset('storage/' . $orderItem->product->images->first()->image_path) }}" 
                     alt="{{ $orderItem->product_name }}" class="product-image">
            @else
                <div class="product-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Image</div>
            @endif
            
            <div class="product-details">
                <h3>{{ $orderItem->product_name }}</h3>
                <div class="product-meta">
                    Quantity: {{ $orderItem->kuantitas }}
                    @if($orderItem->size) | Size: {{ $orderItem->size }} @endif
                </div>
                <div class="product-price">IDR {{ number_format($orderItem->subtotal, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="order-info">
            <strong>Order #{{ $orderItem->order->order_number }}</strong> - 
            Delivered on {{ $orderItem->order->delivered_date->format('d M Y') }}
        </div>
    </div>

    <!-- Review Form -->
    <form action="{{ route('order-history.submit-review', $orderItem->id) }}" method="POST" enctype="multipart/form-data" class="review-form">
        @csrf
        
        <!-- Rating -->
        <div class="form-group">
            <label class="form-label">Rating <span class="required">*</span></label>
            <div class="rating-input">
                <span class="star" data-rating="1">★</span>
                <span class="star" data-rating="2">★</span>
                <span class="star" data-rating="3">★</span>
                <span class="star" data-rating="4">★</span>
                <span class="star" data-rating="5">★</span>
            </div>
            <div class="rating-label" id="rating-label">Click to rate this product</div>
            <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}">
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Review Text -->
        <div class="form-group">
            <label for="review" class="form-label">Your Review</label>
            <textarea name="review" id="review" rows="5" class="form-control @error('review') is-invalid @enderror" 
                      placeholder="Tell us about your experience with this product...">{{ old('review') }}</textarea>
            @error('review')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Recommendation -->
        <div class="form-group">
            <div class="checkbox-wrapper">
                <input type="checkbox" name="is_recommended" id="is_recommended" value="1" 
                       {{ old('is_recommended', true) ? 'checked' : '' }}>
                <label for="is_recommended" class="checkbox-label">I would recommend this product to others</label>
            </div>
        </div>

        <!-- Photo Upload -->
        <div class="form-group">
            <label class="form-label">Add Photos (Optional)</label>
            <div class="file-upload" onclick="document.getElementById('images').click()">
                <div class="upload-icon">📷</div>
                <div class="upload-text">Click to upload photos</div>
                <div class="upload-hint">PNG, JPG up to 2MB each (max 5 photos)</div>
                <input type="file" name="images[]" id="images" multiple accept="image/*">
            </div>
            <div class="image-preview" id="image-preview"></div>
            @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('order-history.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rating functionality
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    const ratingLabel = document.getElementById('rating-label');
    
    const ratingTexts = {
        1: 'Poor - I didn\'t like it',
        2: 'Fair - It was okay',
        3: 'Good - I liked it',
        4: 'Very Good - I really liked it',
        5: 'Excellent - I loved it!'
    };
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;
            updateStars(rating);
            ratingLabel.textContent = ratingTexts[rating];
        });
        
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });
    });
    
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const currentRating = parseInt(ratingInput.value) || 0;
        updateStars(currentRating);
    });
    
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
    
    // Initialize with old rating if available
    const oldRating = {{ old('rating', 0) }};
    if (oldRating > 0) {
        updateStars(oldRating);
        ratingLabel.textContent = ratingTexts[oldRating];
    }
    
    // Image preview functionality
    const imagesInput = document.getElementById('images');
    const imagePreview = document.getElementById('image-preview');
    
    imagesInput.addEventListener('change', function(e) {
        imagePreview.innerHTML = '';
        
        if (this.files.length > 5) {
            alert('Maximum 5 images allowed');
            this.value = '';
            return;
        }
        
        Array.from(this.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" class="preview-image" alt="Preview ${index + 1}">
                        <button type="button" class="remove-image" onclick="removePreviewImage(${index})">×</button>
                    `;
                    imagePreview.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            }
        });
    });
    
    window.removePreviewImage = function(index) {
        const dt = new DataTransfer();
        const files = Array.from(imagesInput.files);
        files.splice(index, 1);
        
        files.forEach(file => dt.items.add(file));
        imagesInput.files = dt.files;
        
        // Refresh preview
        imagesInput.dispatchEvent(new Event('change'));
    };
});
</script>
@endsection