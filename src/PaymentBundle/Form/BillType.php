<?php

namespace PaymentBundle\Form;

use PaymentBundle\Entity\Bill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_return', TextType::class, [
                'attr' => array(
                    'class' => 'datetimepicker',
                    'style' => 'width: 75%; float:left; margin-right:2px'
                ),
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'o',

            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([         
            'data_class' => 'PaymentBundle\Entity\Bill'
        ]);
    }
}