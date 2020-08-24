<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('linge',EntityType::class,array(
                'class'=>'AppBundle\Entity\Linge',
                'choice_label'=>'Libelle',
                'placeholder'=>'-Selectionner-',
                'expanded'=>false,
                'multiple'=>false,
                'attr'=> ['class'=>'chosen-select','multiple'=>false],
            ))
            ->add('couleur',EntityType::class,array(
                'class'=>'AppBundle\Entity\Couleur',
                'choice_label'=>'Libelle',
                'placeholder'=>'-Selectionner-',
                'expanded'=>false,
                'multiple'=>false,
                'attr'=> ['class'=>'chosen-select','multiple'=>false],
            ))
            ->add('tissu',EntityType::class,array(
                'class'=>'AppBundle\Entity\TypeTissu',
                'choice_label'=>'Libelle',
                'placeholder'=>'-Selectionner-',
                'expanded'=>false,
                'multiple'=>false,
                'attr'=> ['class'=>'chosen-select','multiple'=>false],
            ))
            ->add('quantite',IntegerType::class,array('required'=>false))

            ->add('prix',MoneyType::class,array('scale'=>2,'currency'=>false,'mapped'=>true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Depot'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_depot';
    }


}
