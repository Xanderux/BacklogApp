<?php

namespace Claroline\BacklogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VersionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('versionName', 'text', array('max_length' => 80, 'required' => true, 'label' => 'Version'))
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Claroline\BacklogBundle\Entity\Version',
            )
        );
    }

    public function getName()
    {
        return 'version';
    }
}
