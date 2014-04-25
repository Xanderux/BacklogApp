<?php

/*
* This file is part of the Claroline Connect package.
*
* (c) Claroline Consortium <consortium@claroline.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Claroline\BacklogBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
* @DI\Service("form.tinymce")
* @DI\FormType(alias = "tinymce")
*/
class TinymceType extends TextareaType
{
    private $defaultAttributes = array(
        'class' => 'claroline-tiny-mce',
    );

    public function getName()
    {
        return 'tinymce';
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('attr' => $this->defaultAttributes));
        $resolver->setNormalizers(
            array(
                'attr' => function (Options $options, $value) {
                    return array_merge($this->defaultAttributes, $value);
                }
            )
        );

    }
}
