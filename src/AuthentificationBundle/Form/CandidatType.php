<?php

namespace AuthentificationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin',TextType::class)
          //  ->add('roles')
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('date_naissance',TextType::class)
            ->add('email',EmailType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mots de passe'),
                'second_options' => array('label' => 'Répeter mots de passe'),
                'invalid_message' =>'Les deux mots de passe ne  sont pas identiques'
            ))
            ->add('num_telephone',TextType::class)
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('gouvernorat',TextType::class);
            //->add('document_necessaire');
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AuthentificationBundle\Entity\Candidat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'authentificationbundle_candidat';
    }


}
