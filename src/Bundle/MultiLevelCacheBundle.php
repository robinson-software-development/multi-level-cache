<?php

declare(strict_types=1);

namespace Tbessenreither\MultiLevelCache\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Tbessenreither\MultiLevelCache\Bundle\DependencyInjection\Compiler\CompilerPass;
use Tbessenreither\MultiLevelCache\DataCollector\MultiLevelCacheDataCollector;


class MultiLevelCacheBundle extends Bundle
{

	public function build(ContainerBuilder $container): void
	{
		parent::build($container);

		$this->registerMultiLevelCacheServiceCollector($container);

		$container->addCompilerPass(new CompilerPass());
	}

	private function registerMultiLevelCacheServiceCollector(ContainerBuilder $container): void
	{
		$definition = new Definition(MultiLevelCacheDataCollector::class);
		$definition->setPublic(true);
		$definition->addTag('data_collector', [
			'id' => MultiLevelCacheDataCollector::NAME,
			'template' => MultiLevelCacheDataCollector::TEMPLATE,
			'priority' => 334,
		]);
		$definition->setArgument('$appEnv', "%env(APP_ENV)%");
		$definition->setArgument('$enhancedDataCollection', '%env(bool:defined:MLC_COLLECT_ENHANCED_DATA)%');
		$definition->setAutowired(true);
		$definition->setAutoconfigured(true);

		$container->setDefinition(MultiLevelCacheDataCollector::NAME, $definition);
	}

}
