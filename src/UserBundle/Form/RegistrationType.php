<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationType extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class)
        ->add('lastName', TextType::class)
        ->add('address', TextType::class)
        ->add('dateBirth', DateType::class)
        ->add('phoneNumber', TextType::class)
        ->add('drivingLicence', TextType::class)
        
        ;
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getParent()
   	{
      return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   	}
}