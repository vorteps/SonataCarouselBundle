<?php

/*
 * This file is part of the Sonata Carousel project.
 *
 * (c) Stanislav Petrov <s.e.petrov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vorteps\Sonata\CarouselBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\AdminBundle\Form\Type\BooleanType;
use Vorteps\Sonata\CarouselBundle\Block\BaseCarouselBlockService;

/**
 * Twitter Bootstrap carousel
 *
 * @author Stanislav Petrov <s.e.petrov@gmail.com>
 */
class BootstrapCarouselBlockService extends BaseCarouselBlockService
{
    /**
     * @var array
     */
    protected $javascripts;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var boolean
     */
    protected $slide;

    /**
     * @var boolean
     */
    protected $controls;

    /**
     * @param string                                        $name
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param array                                         $javascripts
     * @param array                                         $options
     * @param boolean                                       $slide
     * @param boolean                                       $controls
     */
    public function __construct($name, EngineInterface $templating, $javascripts = array(), $options = array(), $slide = true, $controls = true)
    {
        parent::__construct($name, $templating);
        $this->javascripts = $javascripts;
        $this->options = $options;
        $this->slide = $slide ? BooleanType::TYPE_YES : BooleanType::TYPE_NO;
        $this->controls = $controls ? BooleanType::TYPE_YES : BooleanType::TYPE_NO;
    }

    /**
     * {@inheritdoc}
     */
    public function renderResponse($view, array $parameters = array(), Response $response = null)
    {
        if (isset($parameters['settings']['slide'])) {
            $parameters['settings']['slide'] = ($parameters['settings']['slide'] == BooleanType::TYPE_YES);
        }
        if (isset($parameters['settings']['controls'])) {
            $parameters['settings']['controls'] = ($parameters['settings']['controls'] == BooleanType::TYPE_YES);
        }

        return parent::renderResponse($view, $parameters, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array_merge(parent::getDefaultSettings(), $this->options, array(
            'slide' => $this->slide,
            'controls' => $this->controls
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function getTemplate()
    {
        return 'VortepsSonataCarouselBundle:Block:carousel_bootstrap.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getJavascripts($media)
    {
        return array_merge(parent::getJavascripts($media), $this->javascripts);
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditFormSettings()
    {
        return array_merge(parent::getEditFormSettings(), array(
            array('interval', 'integer', array('required' => false)),
            array('pause', 'choice', array('required' => false, 'choices' => array('hover' => 'hover'))),
            array('slide', 'sonata_type_boolean', array()),
            array('controls', 'sonata_type_boolean', array()),
        ));
    }
}
