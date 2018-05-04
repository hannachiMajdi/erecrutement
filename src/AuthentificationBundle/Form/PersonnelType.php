<?php

namespace AuthentificationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('matricule',TextType::class)
            // ->add('email',EmailType::class)
            // ->add('plainPassword', PasswordType::class)
            // ->add('les_roles', ChoiceType::class, array('choices' =>
            //     array(
            //         'Administrateur Web' => 'ROLE_ADMIN',
            //         'Agent' => 'ROLE_AGENT',
            //         'Responsable' => 'ROLE_RESPONSABLE',
            //     ),
            //     'required'  => true,
            //     'mapped' => false
            // ));

            ->add('matricule',TextType::class)
            ->add('email',EmailType::class)
            ->add('plainPassword', PasswordType::class)
            ->add('roles', ChoiceType::class, array('choices' =>
                array(
                     'Administrateur Web' => 'ROLE_ADMIN',
                    'Agent' => 'ROLE_AGENT',
                    'Responsable' => 'ROLE_RESPONSABLE',
               ),
                 'required'  => true,
                'mapped' => true,
                'multiple'=> true
            ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AuthentificationBundle\Entity\Personnel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'authentificationbundle_personnel';
    }


}
