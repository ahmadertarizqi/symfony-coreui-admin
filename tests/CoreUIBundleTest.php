<?php

namespace Rizk\CoreUIBundle\Tests;

use Twig\Environment;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoreUIBundleTest extends WebTestCase
{
  public static function getKernelClass() 
  {
    return AppKernelTest::class;
  }
  
    public function testInstanceClass()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertInstanceOf(ContainerInterface::class, $container);
    }
    
    public function testInstanceTwig(): Environment
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertTrue($container->has('twig'));
        
        return $container->get('twig');
    }
    
    /**
     * @depends testInstanceTwig
     */
    public function testRenderTemplate(Environment $twig)
    {
        $this->assertStringContainsStringIgnoringCase('<h1>', $twig->render('@CoreUITest/test.html.twig'));
        $this->assertStringContainsStringIgnoringCase('CoreUI Free Bootstrap Admin Template', $twig->render('@CoreUITest/test.html.twig'));
    }
}
