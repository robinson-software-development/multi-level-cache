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

		$container->addCompilerPass(new CompilerPass());
	}

}
