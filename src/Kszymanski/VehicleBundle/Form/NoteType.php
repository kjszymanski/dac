<?php

namespace Kszymanski\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', ['label' => 'Tytuł'])
            ->add('text', 'textarea', ['label' => 'Treść'])
            ->add('priority', 'choice', ['choices' => [1=>1,2=>2,3=>3], 'label' => 'Priorytet'])
            ->add('save', 'submit', ['label' => 'Zapisz']);
    }

    public function getName()
    {
        return 'kszymanskivehicle_note';
    }
}