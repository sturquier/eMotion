<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('address', TextType::class);
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