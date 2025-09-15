{{-- File: resources/views/filament/order-items-modal.blade.php --}}

<div class="p-4">
    <div class="space-y-4">
        @foreach($order->orderItems as $item)
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-4">
                @if($item->product && $item->product->images->isNotEmpty())
                    <img 
                        src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                        alt="{{ $item->product_name }}" 
                        class="w-16 h-16 object-cover rounded-md">
                @else
                    <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                
                <div>
                    <h4 class="font-semibold text-gray-900">{{ $item->product_name }}</h4>
                    <div class="text-sm text-gray-600">
                        <p>Quantity: {{ $item->kuantitas }}</p>
                        @if($item->size)
                            <p>Size: {{ $item->size }}</p>
                        @endif
                        <p>Unit Price: IDR {{ number_format($item->product_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="text-right">
                <p class="font-bold text-lg text-gray-900">
                    IDR {{ number_format($item->subtotal, 0, ',', '.') }}
                </p>
            </div>
        </div>
        @endforeach
        
        <div class="border-t pt-4 mt-4">
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-900">Total Items:</span>
                <span class="font-bold">{{ $order->orderItems->sum('kuantitas') }}</span>
            </div>
            <div class="flex justify-between items-center mt-2">
                <span class="font-semibold text-gray-900">Order Total:</span>
                <span class="font-bold text-lg">IDR {{ number_format($order->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>