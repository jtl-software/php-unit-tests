<?php
$finder = PhpCsFixer\Finder::create()
    ->exclude(__DIR__ . '/vendor')
    ->in([__DIR__ . '/src'])
    ->name('*.php')
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setLineEnding("\n")
    ->setUsingCache(false)
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_after_opening_tag' => true
    ])
    ->setFinder($finder)
;