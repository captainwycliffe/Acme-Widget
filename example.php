<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Acme\Widget\Factory\BasketFactory;

echo "Acme Widget Co - Basket Examples\n";
echo "================================\n\n";


echo "Example 1: B01, G01\n";
$basket1 = BasketFactory::create();
$basket1->add('BO1');
$basket1->add('G01');
echo "Total: $" . number_format($basket1->total(), 2) . "\n\n";

echo "Example 2: R01, R01 (Buy one get one half price)\n";
$basket2 = BasketFactory::create();
$basket2->add('R01');
$basket2->add('R01');
echo "Total: $" . number_format($basket2->total(), 2) . "\n\n";

echo "Example 3: R01, G01\n";
$basket3 = BasketFactory::create();
$basket3->add('R01');
$basket3->add('G01');
echo "Total: $" . number_format($basket3->total(), 2) . "\n\n";


echo "Example 4: B01, B01, R01, R01, R01 (Free delivery + offer)\n";
$basket4 = BasketFactory::create();
$basket4->add('B01');
$basket4->add('B01');
$basket4->add('R01');
$basket4->add('R01');
$basket4->add('R01');
echo "Total: $" . number_format($basket4->total(), 2) . "\n\n";

