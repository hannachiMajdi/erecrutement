<?php

namespace AppBundle\Form;

use AppBundle\Entity\Poste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcourType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reference')
            ->add('annee')
            ->add('titre')
            ->add('mots_cle')
            ->add('lieu')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('documentsNecessaire')
            ->add('introduction',TextareaType::class)
            ->add('maniere',TextareaType::class)
            ->add('observation',TextareaType::class)
            ->add('postes',EntityType::class,array(
                'class'=>Poste::class,
                'multiple'=>true,

            ))

           ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Concour'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_concour';
    }


}
