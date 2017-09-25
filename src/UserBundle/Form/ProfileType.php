<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        ->add('first_name', TextType::class)
        ->add('last_name', TextType::class)
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