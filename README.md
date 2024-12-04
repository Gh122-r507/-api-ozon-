<b style='font-size:28px'>В index.php пример реализации.</b>
<ol><li><b>ApiConnect</b> - это модуль для подключения к api ozon. Он принимает 3 свойства:
<ul><li><b>$url</b> - ссылка для подключения</li>Чтобы задать url надо обратиться к методу setUrl.<br>
<span style="color: rgb(0,245,58)">Пример: <hr></span>
<pre>$url = $ApiConnect->setUrl('Ваш url');</pre>
<li><b>$headers</b> - для ввода ключа api, id клиента. <br>Чтобы задать $headers надо обратиться к методу setHeaders.
<br><span style="color: #00f53a">Пример: </span><hr>
<pre>$headers = $ApiConnect->setHeaders([
    'Client-Id: Ваш id', 
    'Api-Key: Ваш ключ', 
    'Content-Type: application/json',
]);</pre>
</li>
<li><b>$options</b> - для ввода желаемых параметров. <br>Чтобы задать $options надо обратиться к методу setOptions.
<span style="color: #00f53a">Пример:</span> <hr>
<pre>$options = $ApiConnect->setOptions([
    'date_from' => $dateFrom,
    'date_to' => $dateTo,
    "limit" => '1000',
    'dimensions' => ['sku', 'month'],
    'metrics' => ['revenue', 'ordered_units'],
    'ratings' => ['rating_review_avg_score_total','rating_price'],
    'offset' => '0',
]);</pre></li></ul></li></ol>
<ol><li><b>Analytics/InputValueHandler</b> - это модуль для обработки полученных данных аналитики из api ozon. 
Содержит методы: </li>
<ul><li><b>getTotal</b> - Это метод для получения суммы, на которую были заказаны товары за указанный срок.
Принимает декодированный json,полученный от api. <br>
<span style="color: #00f53a">Пример: </span><hr><pre>$total = $ApiHandler->getTotal($data);</pre></li><li><b>getQuantityProducts</b> - модуль для подсчета остатков на складе.Формирует массив с названием товара, его id и количеством.
Принимает декодированный json,полученный от api <br><span style="color: #00f53a">Пример:</span><hr><pre>$products = $ApiHandler->getQuantityProducts($data);</pre></li>
<li><b>getProductDetails</b> - модуль,формирующий итоговое представление информации о товарах.Он включает: id,название и количество товара.Принимает сформированный массив из getQuantityProducts.</li><span style="color: #00f53a">Пример</span><hr> <pre>$products = $ApiHandler->getProductDetails($products);</pre></ul></ol>
