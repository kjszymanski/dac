<?php

namespace Kszymanski\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NoteAssignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('models', 'entity', [
                'class' => 'KszymanskiVehicleBundle:Model',
                'group_by' => 'make.name',
                'property' => 'name',
                'label' => 'Model',
                'multiple' => true,
                'attr' => ['style' => "height: 300px"],
            ])
            ->add('save', 'submit', ["label" => "Przypisz"]);
    }

    public function getName()
    {
        return 'kszymanskivehicle_assignnote';
    }
}