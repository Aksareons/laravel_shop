<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>All price: {{$order->total}}</h1>
    @foreach($orderItem as $item)
    <h2>Name product: {{$item->name}}</h2>
    <h2>Price: {{$item->price}}</h2>
    <h2>quantity: {{$item->quantity}}</h2>
    @endforeach
</body>
</html>