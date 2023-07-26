<?php 
// src/Form/ReservationType.php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_arrivee', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('date_depart', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('prix_total', IntegerType::class)
            ->add('prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('telephone', TextType::class)
            ->add('email', EmailType::class)
            ->add('chambre', EntityType::class, [
                'class' => 'App\Entity\Chambre',
                'choice_label' => 'titre',
                'required' => false,
                'placeholder' => 'Choisir une chambre',
            ])
            ->add('restaurant', EntityType::class, [
                'class' => 'App\Entity\Restaurant',
                'choice_label' => 'titre',
                'required' => false,
                'placeholder' => 'Choisir un restaurant',
            ])
            ->add('spa', EntityType::class, [
                'class' => 'App\Entity\Spa',
                'choice_label' => 'titre',
                'required' => false,
                'placeholder' => 'Choisir un spa',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
