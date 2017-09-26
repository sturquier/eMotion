<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class, ['label' => 'Prenom'])
        ->add('lastName', TextType::class, ['label' => 'Nom'])
        ->add('address', TextType::class, ['label' => 'Adresse'])
        ->add('birthDate', DateType::class, ['label' => 'Date de naissance'])
        ->add('phoneNumber', TextType::class, ['label' => 'Numero de telephone'])
        ->add('drivingLicense', TextType::class, ['label' => 'Numero de permis de conduire']);
    }

    public function getParent()
   	{
      return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   	}

    public function getBlockPrefix()
    {
        return 'userbundle_user_registration';
    }
}