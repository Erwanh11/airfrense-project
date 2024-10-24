<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\TypeBillet;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class Reservation1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'label' => 'Nom complet du passager'
            ])
            ->add('dateDepart', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de départ'
            ])
            ->add('villeDepart', TextType::class, [
                'label' => 'Ville de départ'
            ])
            ->add('villeArrivee', TextType::class, [
                'label' => 'Ville d\'arrivée'
            ])
            ->add('typeBillet', EntityType::class, [
                'class' => TypeBillet::class, 
                'choice_label' => 'nom', 
                'label' => 'Type de billet',
                'placeholder' => 'Sélectionnez un type de billet', 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
