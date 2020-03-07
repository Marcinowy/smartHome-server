<?php

namespace App\Form;

use App\Entity\Devices;
use App\Entity\IOTTypes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mac', null, [
                'label' => 'Adres MAC urządzenia',
                'required' => true,
            ])
            ->add('token', null, [
                'label' => 'Token autoryzacyjny',
                'required' => true,
            ])
            ->add('type', EntityType::class, [
                'class' => IOTTypes::class,
                'choice_label' => 'name',
                'label' => 'Typ urządzenia',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Dodaj urządzenie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devices::class,
        ]);
    }
}
