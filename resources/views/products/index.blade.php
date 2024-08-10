<x-layout>
    <x-slot:title>
        Home
        </x-slot>

        <div class="container ">
            @php
                $sort_current_field = request()->query('field', 'created_at');
                $sort_current_order = request()->query('order', 'desc');

                $new_order = $sort_current_order === 'asc' ? 'desc' : 'asc';
                $fa_direction = $sort_current_order === 'asc' ? 'up' : 'down';

                $fields = [
                    'id',
                    'name',
                    'description',
                    'slug',
                    'price'
                ];

                $field_url = [];

                foreach ($fields as $field) {
                    $field_url[$field] = request()->fullUrlWithQuery(['field' => $field, 'order' =>
                    $new_order]);
                }

            @endphp  
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-secondary" id="list">
                                List View
                            </button>
                            <button class="btn btn-info" id="grid">
                                Grid View
                            </button>
                        </div>
                        <a href="{{ $field_url['name'] }}" class="btn btn-success ml-5">Sort
                            <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                        </a>
                    </div>
                </div>
            </div> 
            <div id="products" class="row view-group">
            @forelse ($products as $product)
                <div class="item col-xs-4 col-lg-4 grid-group-item">
                    <div class="card">                        
                        <div class="caption card-body">
                            <h4 class="group card-title inner list-group-item-heading">{{ $product->name }}</h4>
                            <p class="group inner list-group-item-text">{{ \Illuminate\Support\Str::limit($product->description, 50, $end='...') }}</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">${{ $product->price }} </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="/products/{{ $product->slug }}">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div>
                    <p class="text-center">No products found for <b>{{ request('search') }}</b>.</p>
                </div>
            @endforelse
            </div>           
            <div class="row mt-3">
                <div class="col">
                    <div>
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-layout>
<script type="text/javascript">
$(function() {
    $('#list').click(function(event){
        event.preventDefault();
        $('#products .item').removeClass('grid-group-item').addClass('list-group-item');
        $(this).removeClass('btn-secondary').addClass('btn-info');
        $('#grid').removeClass('btn-info').addClass('btn-secondary');
    });
    $('#grid').click(function(event){
        event.preventDefault();
        $('#products .item').removeClass('list-group-item').addClass('grid-group-item');   
        $(this).removeClass('btn-secondary').addClass('btn-info');  
        $('#list').removeClass('btn-info').addClass('btn-secondary');       
    });   
});
</script>