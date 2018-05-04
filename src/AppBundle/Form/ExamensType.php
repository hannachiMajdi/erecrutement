<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamensType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('examens',CollectionType::class,
            array(
            'entry_type' => ExperienceType::class,
                'entry_options' => array('label' => false),
                 'by_reference' => true,
            ));*/
    }



}
