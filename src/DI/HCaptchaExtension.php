<?php declare(strict_types = 1);

namespace Dravencms\HCaptcha\DI;

use Dravencms\HCaptcha\HCaptchaProvider;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class HCaptchaExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'siteKey' => Expect::string()->required()->dynamic(),
			'secretKey' => Expect::string()->required()->dynamic()
		]);
	}

	/**
	 * Register services
	 */
	public function loadConfiguration(): void
	{
		$config = (array) $this->getConfig();
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('provider'))
			->setFactory(HCaptchaProvider::class, [$config['siteKey'], $config['secretKey']]);
	}
}
