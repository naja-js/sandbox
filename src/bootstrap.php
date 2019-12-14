<?php

declare(strict_types = 1);

namespace Naja\Sandbox;

use Nette\Configurator;
use Nette\DI\Container;
use Nette\StaticClass;
use Tracy\Debugger;


require __DIR__ . '/../vendor/autoload.php';


final class Bootstrap
{

	use StaticClass;


	public static function boot(?string $configFIle = null): Container
	{
		$configurator = new Configurator();

		$configurator->addParameters([
			'rootDir' => __DIR__ . '/..',
			'logDir' => __DIR__ . '/../log',
			'tempDir' => $tempDir = __DIR__ . '/../temp',
		]);

		$configurator->setTempDirectory($tempDir);
		Debugger::$strictMode = true;

		$configurator->addConfig(__DIR__ . '/../config/config.neon');
		$configurator->addConfig($configFIle ?? []);

		return $configurator->createContainer();
	}

}
