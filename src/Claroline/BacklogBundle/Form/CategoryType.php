<?php

namespace Claroline\BacklogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('max_length' => 80, 'required' => false, 'label' => 'Catégories'))
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Claroline\BacklogBundle\Entity\Category',
            )
        );
    }

    public function getName()
    {
        return 'name';
    }
}
