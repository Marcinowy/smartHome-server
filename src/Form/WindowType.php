<?php

namespace App\Form;

use App\Entity\Devices;
use App\Entity\Map;
use App\Entity\Okna;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WindowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nazwa okna'
            ])
            ->add('map', EntityType::class, [
                'class' => Map::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Wybierz mapę (pozostaw puste, w przypadku braku mapy)'
            ])
            ->add('x_pos', null, [
                'attr' => [
                    'class' => 'positionField'
                ],
                'required' => false,
                'label' => 'Pozycja X na mapie'
            ])
            ->add('y_pos', null, [
                'attr' => [
                    'class' => 'positionField'
                ],
                'required' => false,
                'label' => 'Pozycja Y na mapie'
            ])
            ->add('deviceId', EntityType::class, [
                'class' => Devices::class,
                'choice_label' => 'id',
                'label' => 'ID urządzenia obsługującego okno'
            ])

            ->add('pin_open', null, [
                'attr' => [
                    'class' => 'changableFields'
                ],
                'required' => false,
                'mapped' => false,
                'label' => 'Pin na arduino otwierający okno'
            ])
            ->add('pin_close', null, [
                'attr' => [
                    'class' => 'changableFields'
                ],
                'required' => false,
                'mapped' => false,
                'label' => 'Pin na arduino zamykający okno'
            ])
            ->add('pin_check', null, [
                'attr' => [
                    'class' => 'changableFields'
                ],
                'required' => false,
                'mapped' => false,
                'label' => 'Pin na arduino sprawdzający stan okna'
            ])
            
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Dodaj okno'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Okna::class,
        ]);
    }
}
