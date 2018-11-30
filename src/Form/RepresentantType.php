<?php

namespace App\Form;

use App\Entity\Representant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepresentantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse_1')
            ->add('adresse_2')
            ->add('telephone_1')
            ->add('telephone_2')
            ->add('email_1')
            ->add('email_2')
            ->add('role_id')
            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Representant::class,
        ]);
    }
}
