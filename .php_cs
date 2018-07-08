<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$fixers = [
    'array_syntax' => ['syntax' => 'short'],
];

return Config::create()
    ->setFinder(Finder::create()->in(__DIR__))
    ->setRules(
        [
            '@Symfony' => true,
        ] + $fixers
    )
    ->setUsingCache(true);
