<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel {
	public function registerBundles() {
		return array(
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
			new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Truelab\KottiModelBundle\TruelabKottiModelBundle(),
			new Truelab\KottiEsBundle\TruelabKottiEsBundle(),

		);
	}

	public function registerContainerConfiguration(LoaderInterface $loader) {
		$loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
	}

	/**
	 * @return string
	 */
	public function getCacheDir() {
		return sys_get_temp_dir() . '/TruelabKottiEsBundle/cache';
	}

	/**
	 * @return string
	 */
	public function getLogDir()
	{
		return sys_get_temp_dir() . '/TruelabKottiEsBundle/logs';
	}

}
