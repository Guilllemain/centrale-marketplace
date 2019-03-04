<?php

if (! function_exists('utf8ize')) {
    function utf8ize($data)
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = utf8ize($v);
            }
        } elseif (is_string($data)) {
            return utf8_encode($data);
        }
        return $data;
    }
}

function getProductPath($product)
{
    $productPath = [];
    for ($i = 0; $i < 3; $i++) {
        array_push($productPath, $product['categoryPath'][$i]['slug']);
    }
    $finalPath = '/' . implode('/', $productPath) . '/' . $product['slug'];
    return $finalPath;
}

function breadcrumbLinks($fullPath, $index)
{
    $path = [];
    for ($i = 0; $i <= $index; $i++) {
        array_push($path, $fullPath[$i]['slug']);
    }
    $finalPath = '/' . implode('/', $path);
    return $finalPath;
}

function formatPrice($price)
{
    $price = number_format($price, 2, ',', ' ') . ' €';
    return $price;
}

function limitStringLength($string)
{
    if (strlen($string) > 27) {
        return substr($string, 0, 27) . '...';
    }
    return $string;
}

function inStock($stock)
{
    if ($stock) {
        return 'En stock';
    } else {
        return 'Indisponible';
    }
}

function calcDiscount($newPrice, $oldPrice)
{
    return formatPrice($oldPrice - $newPrice);
}
