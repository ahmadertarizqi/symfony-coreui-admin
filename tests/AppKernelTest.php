<?php

namespace Rizk\CoreUIBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppKernelTest extends Kernel
{
  public function registerBundles()
  {
    return [
            new \Rizk\CoreUIBundle\CoreUIBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle()
        ];
  }

  public function registerContainerConfiguration(LoaderInterface $loader)
  {
    $loader->load(function (ContainerBuilder $container) use ($loader) {
            $loader->load(__DIR__ . DIRECTORY_SEPARATOR . 'config/config.yml');
            $loader->load(__DIR__ . DIRECTORY_SEPARATOR . 'config/bundle.yml');
            
            $container->addObjectResource($this);
        });
  }
}