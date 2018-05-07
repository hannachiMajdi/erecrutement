<?php

namespace AppBundle\Form;

use AppBundle\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatSpecialiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee',TextType::class,array
            (
                'attr'=>['class'=>' form-control']  ,
                'label'=>'Année du diplome',
                'label_attr'=>['clsass'=>' control-label']
            ))
            ->add('fac',TextType::class,array
            (
                'attr'=>['class'=>' form-control']  ,
                'label'=>'Faculté ou institut',
                'label_attr'=>['class'=>'control-label']
            ))
            ->add('specialite',EntityType::class,array(
                'class'=>Specialite::class,
                'attr'=>['class'=>' form-control']  ,
                'label'=>'Spécialité',
                'label_attr'=>['class'=>'control-label']
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CandidatSpecialite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_candidatspecialite';
    }


}
