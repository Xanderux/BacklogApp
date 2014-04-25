<?php

namespace Claroline\BacklogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'tinymce', array('required' => true, 'label' => 'Commentaire :'))
            ->add('ajouter', 'submit');
    }

    public function getName()
    {
        return 'name';
    }
}
