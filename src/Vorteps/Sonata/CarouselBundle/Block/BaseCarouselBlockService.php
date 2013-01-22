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

use Sonata\PageBundle\Block\ContainerBlockService;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;

/**
 * Base carousel class
 *
 * @author Stanislav Petrov <s.e.petrov@gmail.com>
 */
class BaseCarouselBlockService extends ContainerBlockService
{
    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        parent::buildEditForm($formMapper, $block);

        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => $this->getEditFormSettings()
        ));
    }

    /**
     * Returns the carousel settings
     *
     * @return array
     */
    protected function getEditFormSettings()
    {
        return array(
            array('layout', 'textarea', array()),
            array('class', 'text', array('required' => false)),
        );
    }
}
