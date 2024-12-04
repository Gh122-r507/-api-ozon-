<?php

declare(strict_types=1);
require "Modules/ApiConnect.php";
require "Modules/Analytics/InputValueHandler.php";

use Modules\Analytics\InputValueHandler;
use Modules\ApiConnect;

$ApiConnect = new ApiConnect();
$ApiHandler = new InputValueHandler();

$dateFrom = date("Y-m-d - 60days");
$dateTo = date("Y-m-d");
$url = $ApiConnect->setUrl('https://api-seller.ozon.ru/v1/analytics/data');
$headers = $ApiConnect->setHeaders([
    'Client-Id: Ваш id',
    'Api-Key: Ваш ключ',
    'Content-Type: application/json',
]);
$options = $ApiConnect->setOptions([
    'date_from' => $dateFrom,
    'date_to' => $dateTo,
    "limit" => '1000',
    'dimensions' => ['sku', 'month'],
    'metrics' => ['revenue', 'ordered_units'],
    'ratings' => ['rating_review_avg_score_total', 'rating_price'],
    'offset' => '0',
]);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);

$response = curl_exec($curl);
$data = json_decode($response, true);
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
}
curl_close($curl);

$total = $ApiHandler->getTotal($data);
$products = $ApiHandler->getQuantityProducts($data);
$products = $ApiHandler->getProductDetails($products);
echo '======================================================' . "</br>";
echo "Всего заказно на сумму:  $total" . '</br>';
echo '======================================================';

echo '<pre>';
print_r($data);
echo '</pre>';