<?php

namespace Claroline\BacklogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('max_length' => 80, 'required' => true, 'label' => 'Sujet'))
            ->add('description', 'textarea', array('required' => false, 'label' => 'Description'))
            ->add('priority', 'number', array('label' => 'Priorité'))
            ->add('time', 'text', array('max_length' => 80, 'required' => false, 'label' => 'Temps'))
            ->add('path', 'text', array('max_length' => 80, 'required' => false, 'label' => 'Chemin'))
            ->add(
                'status',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Status',
                    'property' => 'statusName',
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.statusName', 'ASC'); }

                )
            )
            ->add(
                'version',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Version',
                    'property' => 'versionName',
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.versionName', 'ASC'); }

                )
            )
            ->add(
                'categories',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Category',
                    'property' => 'name',
                    'multiple' => true,
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.name', 'ASC'); }

                )
            )
            ->add(
                'packages',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Package',
                    'property' => 'name',
                    'multiple' => true,
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.name', 'ASC'); }

                )
            )
            ->add(
                'roles',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Role',
                    'property' => 'name',
                    'multiple' => true,
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.name', 'ASC'); }

                )
            )
            ->add(
                'teams',
                'entity',
                array(
                    'class' => 'Claroline\BacklogBundle\Entity\Team',
                    'property' => 'name',
                    'multiple' => true,
                    'query_builder' => function ($repository) { return $repository->createQueryBuilder('p')->orderBy('p.name', 'ASC'); }

                )
            )

            ->add('isValidated', 'checkbox', array('required' => false, 'label' => 'Validé'))
            ->add('isBlocked', 'checkbox', array('required' => false, 'label' => 'Fermer les commentaires'))
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Claroline\BacklogBundle\Entity\Ticket',
        ));
    }

    public function getName()
    {
        return 'ticket';
    }
}
