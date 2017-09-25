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

class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('brand', TextType::class, ['label' => 'Marque'])
        ->add('model', TextType::class, ['label' => 'Modèle'])
        ->add('serialNumber', IntegerType::class, ['label' => 'N° de série'])
        ->add('color', TextType::class, ['label' => 'Couleur'])
        ->add('numberPlate',TextType::class, ['label' => 'N° d\'immatriculation'])
        ->add('kilometer', IntegerType::class, ['label' => 'Nombre de kilomètres au compteur'])
        ->add('datePurchase', DateType::class, ['label' => 'Date d\'achat'])
        ->add('pricePurchase', NumberType::class, ['label' => 'Prix d\'achat'])
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
