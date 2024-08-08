<x-layout>
    <x-slot:title>
        Product Info - {{ $product->name }}
        </x-slot>

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h3>Product Information</h3>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-7">
                    <div class="row justify-content-start">                        
                        <div class="col">    
                            <div class="row mb-2">
                                <div class="col"><strong>Product Name:</strong></div>
                                <div class="col">{{ $product->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">Product Description:</div>
                                <div class="col">{{ $product->description }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><strong>Price:</strong></div>
                                <div class="col">₹ {{ $product->price }}</div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">                    
                    <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
</x-layout>