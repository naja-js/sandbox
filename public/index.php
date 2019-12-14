<?php

declare(strict_types = 1);

require __DIR__ . '/../src/bootstrap.php';

$container = \Naja\Sandbox\Bootstrap::boot(null);
$container->getByType(\Nette\Application\Application::class)->run();
