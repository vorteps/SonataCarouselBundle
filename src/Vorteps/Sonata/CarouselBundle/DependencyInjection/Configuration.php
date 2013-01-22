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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Stanislav Petrov <s.e.petrov@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vorteps_sonata_carousel');

        $rootNode
            ->children()
                ->arrayNode('bootstrap')
                    ->info('Twitter Bootstrap carousel configuration.')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->variableNode('class')
                            ->info('The Twitter Bootstrap carousel class.')
                            ->defaultValue('Vorteps\Sonata\CarouselBundle\Block\BootstrapCarouselBlockService')
                            ->treatNullLike('Vorteps\Sonata\CarouselBundle\Block\BootstrapCarouselBlockService')
                            ->validate()
                                ->ifTrue(function($v) { return !is_string($v); })
                                ->thenInvalid('Class must be a string.')
                            ->end()
                        ->end()

                        ->variableNode('javascripts')
                            ->info('The path to the Twitter Bootstrap carousel JavaScript file or any other JavaScript files to be included by the block service.')
                            ->example('[ /path/to/twitter/bootstrap/js/bootstrap-carousel.js ]')
                            ->defaultValue(array())
                            ->treatNullLike(array())
                            ->beforeNormalization()
                            ->ifString()
                                ->then(function($v) { return array($v); })
                            ->end()
                        ->end()

                        ->arrayNode('options')
                            ->info('Twitter Bootstrap carousel default options. See http://twitter.github.com/bootstrap/javascript.html#carousel for valid options.')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('interval')
                                    ->info('The delay between automatically cycling an item in miliseconds. If false, carousel will not automatically cycle.')
                                    ->example('5000|false')
                                    ->defaultValue(5000)
                                    ->treatNullLike(5000)
                                    ->validate()
                                        ->ifTrue(function($v) { return $v <= 0; })
                                        ->thenInvalid('Inverval must be greater than zero.')
                                    ->end()
                                ->end()
                                ->enumNode('pause')
                                    ->info('Pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave.')
                                    ->example('hover|false')
                                    ->defaultValue('hover')
                                    ->treatNullLike('hover')
                                    ->values(array('hover', false))
                                ->end()
                            ->end()
                        ->end()

                        ->booleanNode('slide')
                            ->info('Whether to use slide transition (if supported) by default.')
                            ->example('true|false')
                            ->defaultValue(true)
                            ->treatNullLike(true)
                        ->end()

                        ->booleanNode('controls')
                            ->info('Whether to display controls by default.')
                            ->example('true|false')
                            ->defaultValue(true)
                            ->treatNullLike(true)
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
