<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new  Assert\Regex(array(
                    'pattern' => '/\d/',
                    'match'   => false
                )),
                new Assert\Length(array('min' => 3))
            )
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Nom',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new  Assert\Regex(array(
                    'pattern' => '/\d/',
                    'match'   => false
                ))
            )
        ])
        ->add('address', TextType::class, [
            'label' => 'Adresse',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
            )
        ])
        ->add('birthDate', DateType::class, [
            'label' => 'Date de naissance',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Date()
            )
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Numéro de téléphone',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Type('numeric')
            )
        ])
        ->add('drivingLicense', TextType::class, [
            'label' => 'Numéro de permis de conduire',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Type('string')
            )
        ])
        ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
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