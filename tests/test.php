<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Nicklayb\HtmlBuilder\Tags\Table;

$table = new Table;

$table->head([
    'test',
    'dest',
    'rest'
]);

echo $table->make();
