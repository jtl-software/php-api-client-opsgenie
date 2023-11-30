<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$finder = PhpCsFixer\Finder::create();
$finder->in(['src', 'tests', 'public']);

$config = new PhpCsFixer\Config();
$config->setFinder($finder);
$config->setRules(['@PSR12' => true]);

return $config;