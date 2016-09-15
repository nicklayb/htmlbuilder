<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Nicklayb\HtmlBuilder\Tags\Table;
use Nicklayb\HtmlBuilder\Tags\Div;

$div = new Div([
    'main',
    'primary-div'
]);
$div->child(
    (new Div('second'))->child(
        (new Div('third'))->content('Tada, stuff!')
    )
);

echo $div->make();
