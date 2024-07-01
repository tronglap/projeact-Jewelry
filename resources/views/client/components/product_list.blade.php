@foreach ($datas as $data)
    <div class="col-lg-3 Cart_list">
        <x-client.card :name="$data->name" :price="number_format($data->price, 2, '.', ',')" :quantity="$data->quantity" :productid="['product' => $data->id]" :category="$data->ProductCategory->name"
            :imageurl="$data->image_url" :imageurlsecond="$data->image_url_second" :sale="$data->sale" :promotion="number_format($data->promotion, 2, '.', ',')" />
    </div>
@endforeach
