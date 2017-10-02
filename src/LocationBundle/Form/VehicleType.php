<?php

namespace LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;


class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('brand', TextType::class, [
            'label' => 'Marque',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new  Assert\Regex(array(
                    'pattern' => '/\d/',
                    'match'   => false
                )),
                new Assert\Length(array(
                    'min' => 3, 
                    'max' => 80
                ))
            )
        ])
        ->add('model', TextType::class, [
            'label' => 'Modèle',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'attr' => [
                'placeholder' => 'ex: Vectra',
            ]
        ])
        ->add('serialNumber', TextType::class, [
            'label' => 'N° de série',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min' => 17, 
                    'max' => 17
                ))
            ),
            'attr' => [
                'placeholder' => 'ex: 9PL0B630OZ87B66UX',
            ]
        ])
        ->add('color', TextType::class, [
            'label' => 'Couleur',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'attr' => [
                'placeholder' => 'ex: Saumon',
            ]
        ])
        ->add('numberPlate',TextType::class, [
            'label' => 'N° d\'immatriculation',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'attr' => [
                'placeholder' => 'ex: LR-965-SX 01',
            ]
        ])
        ->add('kilometer', IntegerType::class, [
            'label' => 'Nombre de kilomètres au compteur',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'attr' => [
                'placeholder' => 'ex: 15000',
            ]
        ])
        ->add('datePurchase', DateType::class, [
            'label' => 'Date d\'achat',
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Date()
            )
        ])
        ->add('pricePurchase', NumberType::class, [
            'label' => 'Prix d\'achat',
            'constraints' => array(
                new Assert\NotBlank()
            )
        ])
        ->add('submit', SubmitType::class, ['label' => 'Enregister']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LocationBundle\Entity\Vehicle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'locationbundle_vehicle';
    }


}
