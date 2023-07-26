<?php

namespace App\Form;

use App\Entity\Spa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('photo', FileType::class, [
                'required' => false,
            ])
            ->add('prix', MoneyType::class, [
                'currency' => 'EUR',
            ])
            ->add('description', TextareaType::class)
            ->add('duree', TextType::class)
            ->add('date_enregistrement');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spa::class,
        ]);
    }
}
