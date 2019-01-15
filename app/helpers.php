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

function formatPrice($price)
{
    $price = number_format($price, 2, ',', ' ');
    return $price;
}
