<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('first_name', TextType::class, ['label' => 'Prénom'])
        ->add('last_name', TextType::class, ['label' => 'Nom'])
        ->add('address', TextType::class, ['label' => 'Adresse'])
        ->add('birthDate', BirthdayType::class, ['label' => 'Date de naissance'])
        ->add('phoneNumber', TextType::class, ['label' => 'Numéro de téléphone'])
        ->add('drivingLicense', TextType::class, ['label' => 'Permis de conduire'])
        ->add('submit', SubmitType::class, ['label' => 'Mettre a jour']);
    }
    
    public function getParent()
    {
       return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user_profile';
    }
}