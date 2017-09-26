<?php

namespace LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use LocationBundle\Entity\Vehicle;

class OfferType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vehicle', EntityType::class, array(
                'class' => 'LocationBundle:Vehicle',
                'choice_label' => 'brand',
        ))
        ->add('priceLocation', NumberType::class, ['label' => 'Prix de la location'])
        ->add('date_begin', DateType::class, ['label' => 'Date de début'])
        ->add('date_end', DateType::class, ['label' => 'Date de fin'])
        ->add('submit', SubmitType::class, ['label' => 'Enregister']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LocationBundle\Entity\Offer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'locationbundle_offer';
    }


}
