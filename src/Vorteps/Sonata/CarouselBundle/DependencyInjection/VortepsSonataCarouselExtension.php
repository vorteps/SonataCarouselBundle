<?php

/*
 * This file is part of the Sonata Carousel project.
 *
 * (c) Stanislav Petrov <s.e.petrov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vorteps\Sonata\CarouselBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Stanislav Petrov <s.e.petrov@gmail.com>
 */
class VortepsSonataCarouselExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('vorteps_sonata_carousel.bootstrap.class', $config['bootstrap']['class']);
        $container->setParameter('vorteps_sonata_carousel.bootstrap.javascripts', $config['bootstrap']['javascripts']);
        $container->setParameter('vorteps_sonata_carousel.bootstrap.options', $config['bootstrap']['options']);
        $container->setParameter('vorteps_sonata_carousel.bootstrap.slide', $config['bootstrap']['slide']);
        $container->setParameter('vorteps_sonata_carousel.bootstrap.controls', $config['bootstrap']['controls']);
    }
}
