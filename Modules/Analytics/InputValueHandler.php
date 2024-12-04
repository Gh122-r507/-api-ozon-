<?php

namespace Modules\Analytics;

class InputValueHandler
{
    public function getTotal($value)
    {
        foreach ($value['result']['totals'] as $item) {
            $result = $item;
            break;
        }
        return $result;
    }
    public function getQuantityProducts($value)
    {
        $products = [];
        foreach ($value['result']['data'] as $item) {
            foreach ($item['dimensions'] as $dimension) {
                if ($dimension['name'] == null) {
                    continue;
                } else {
                    if (isset($products[$dimension['name']])) {
                        $products[$dimension['name']]['quantity'] += 1;
                    } else {
                        $products[$dimension['name']] = [
                            'id' => $dimension['id'],
                            'name' => $dimension['name'],
                            'quantity' => 1
                        ];
                    }
                }
            }
        }
        return $products;
    }
    public function getProductDetails($value) {
        foreach ($value as $product) {
            $result[] = 'id: ' . $product['id'] . '</br>' .
                'Название: ' . $product['name'] . '</br>' .
                'Количество: ' . $product['quantity'] . '</br>';
        }
        echo implode('', $result);
    }


}