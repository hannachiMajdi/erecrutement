<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('societe',TextType::class,array
                    (
                      'attr'=>['class'=>' form-control']  ,
                        'label'=>'Société',
                        'label_attr'=>['class'=>' control-label']
                ))
           ->add('poste',TextType::class,array
            (
               'attr'=>['class'=>' form-control']  ,
                'label'=>'Poste',
                'label_attr'=>['class'=>'control-label']
            ))
            ->add('datedebut',TextType::class,array
            (
               'attr'=>['class'=>' form-control bootstrap-datepicker']  ,
                'label'=>'Date de début',
                'label_attr'=>['class'=>'control-label']
            ))
            ->add('datefin',TextType::class,array
            (
                'attr'=>['class'=>' form-control bootstrap-datepicker']  ,
                'label'=>'Date de Fin',
                'label_attr'=>['class'=>'control-label']
            ))
            ->add('description',TextAreaType::class,array
            (
                'attr'=>['class'=>' form-control']  ,
                'label'=>'Description',
                'label_attr'=>['class'=>'control-label']
            ))
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_experience';
    }


}
