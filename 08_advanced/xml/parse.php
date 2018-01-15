<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 17:24
 */

header('Content-type: text/plain');

$filename = 'dom_result.xml';




$dom = new DOMDocument();
$dom->load($filename);

//$finder = new DOMXPath($dom);
//$result = $finder->query('//product(@contains(name=iPhone))');
//var_dump($result);


$products = $dom->getElementsByTagName('product');

echo 'Reading products...'.PHP_EOL;
foreach ($products as $product) {
    /** @var DOMElement $product */
    echo $product->getAttribute('name') . ' - ' . $product->getAttribute('price').PHP_EOL;
}

$categories = $dom->getElementsByTagName('category');

echo 'Reading categories...'.PHP_EOL;
foreach ($categories as $cat) {
    /** @var DOMElement $cat */
    echo $cat->getAttribute('name') . ' - ' . $cat->getAttribute('uri').PHP_EOL;
    echo $cat->textContent.PHP_EOL.PHP_EOL;
}


return;



echo PHP_EOL.'Simple XML:'.PHP_EOL;

$simple = new SimpleXMLElement(
    file_get_contents($filename)
);

foreach ($simple->products->product as $product) {
    /** @var SimpleXMLElement $product */
    echo $product['name'] . ' - ' . $product['price'].PHP_EOL;
}

echo PHP_EOL.'Categories:'.PHP_EOL;
foreach ($simple->categories->category as $cat) {
    /** @var SimpleXMLElement $product */
    echo $cat['name'] . ' - ' . $cat['uri'].PHP_EOL;
}
