<?php

namespace App\Form;

use App\Entity\FormeMachoire;
use App\Entity\Sexe;
use App\Entity\InfoClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class InfoClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'required' => false
            ])
            ->add('nom')
            ->add('docteur')
            ->add('mail', EmailType::class, [
            ])
            ->add('age')
            ->add('sexe', EntityType::class, [
                'class' => Sexe::class,
                'choice_label' => 'nom',
                'expanded' => true,
            ])
            ->add('formeMachoire', EntityType::class, [
                'class' => FormeMachoire::class,
                'choice_label' => 'typeforme',
                
            ])
            ->add('bruxisme')
            ->add('rendezVouses')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoClient::class,
        ]);
    }
}
