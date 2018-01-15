<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 16:26
 */



$xmlStr = '<?xml version="1.0" encoding="utf-8"?>
<body>
    <products>
        <product name="iPhone SE" price="10000"/>
        <product name="iPhone X" price="30000"/>
        <product name="iPhone 5" price="8000"/>
    </products>
    <!-- comment -->
    <categories>
        <category name="iPhone" uri="/iphone/">You can find iPhones here.</category>
        <category name="Macbook" uri="/mac/">You can find Macbooks here.</category>
        <category name="iMac" uri="/imac/">You can find iMacs here.</category>
    </categories>
</body>
';

file_put_contents('raw.xml', $xmlStr);

echo 'File created!';
die();


















$data = [
  'products' => [
      ['iPhone SE', 10000],
      ['iPhone X', 30000],
      ['iPhone 5', 8000],
  ],
  'categories' => [
      ['iPhone', '/iphone/', 'You can find iPhones here.'],
      ['Macbook', '/mac/', 'You can find Macbooks here.'],
      ['iMac', '/imac/', 'You can find iMacs here.<tag/>'],
  ],
];




$dom = new DOMDocument('1.0', 'utf-8');
$root = $dom->createElement('root');

$products = $dom->createElement('products');

foreach ($data['products'] as $product) {
    $productElement = $dom->createElement('product');
    $productElement->setAttribute('name', $product[0]);
    $productElement->setAttribute('price', $product[1]);

    $products->appendChild($productElement);
}
$root->appendChild($products);



$categories = $dom->createElement('categories');
foreach ($data['categories'] as $category) {
    //$catElement = $dom->createElement('category', $category[2]);
    $catElement = $dom->createElement('category');

    $textNode = $dom->createTextNode($category[2]);
    $catElement->appendChild($textNode);

    $catElement->setAttribute('name', $category[0]);
    $catElement->setAttribute('uri', $category[1]);

    $categories->appendChild($catElement);
}
$root->appendChild($categories);

$dom->appendChild($root);


header('Content-type: text/xml');

echo $dom->saveXML();

return;

if ($dom->save('dom_result.xml')) {
    echo 'Файл успешно создан';
} else {
    echo 'Ошибка при записи файла';
}