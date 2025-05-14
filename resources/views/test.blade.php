{{$sale}} <br>

@foreach ($sale->products as $product )
    {{$product->name}}<br>
@endforeach
