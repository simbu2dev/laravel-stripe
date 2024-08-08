<x-layout>
    <x-slot:title>
        Home
        </x-slot>

        <div class="container ">
            <div class="row mb-4 ">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                @php
                                $sort_current_field = request()->query('field', 'created_at');
                                $sort_current_order = request()->query('order', 'desc');

                                $new_order = $sort_current_order === 'asc' ? 'desc' : 'asc';
                                $fa_direction = $sort_current_order === 'asc' ? 'up' : 'down';

                                $fields = [
                                    'id',
                                    'name',
                                    'slug',
                                    'price'
                                ];

                                $field_url = [];

                                foreach ($fields as $field) {
                                $field_url[$field] = request()->fullUrlWithQuery(['field' => $field, 'order' =>
                                $new_order]);
                                }

                                @endphp                                
                                <th>
                                    <a href="{{ $field_url['name'] }}">Product Name
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $field_url['price'] }}">Price (₹)
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                    </a>
                                </th>                                
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td> {{ $product->name }} </td>
                                <td> {{ $product->price }} </td>
                                <td>
                                    <a href="/products/{{ $product->slug }}" class="text-decoration-none">
                                        <button type="button" class="btn btn-link">
                                            <i class="fa-regular fa-pen-to-square"></i> Buy now
                                        </button>
                                    </a>                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No products found for <b>{{ request('search') }}</b>.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-layout>