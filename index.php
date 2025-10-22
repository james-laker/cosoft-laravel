<?php

require __DIR__ . '/vendor/autoload.php';
use Tightenco\Collect\Support\Collection;

$data = json_decode(file_get_contents('products.json'));

$collection = new Collection($data);

$cost = $collection->sum('price_in_pence') / 100;

echo 'The total sum of prices is £'. $cost .'<br>';

$costPL = $collection->filter(function ($item) {
    return in_array($item->category, ['Phone', 'Laptop']);
})->sum('price_in_pence') / 100;

echo 'The total sum of prices for phones and laptops is £'. $costPL .'<br>';

$graphicsCards = $collection->where('category','=', 'Graphics Card')->count();

echo 'The total number of graphics cards is '. $graphicsCards .'<br>';

$phone = $collection->where('category', '=', 'Phone')
    ->pluck('name')
    ->implode(', ');

echo 'The list of phones is '. $phone .'<br>';