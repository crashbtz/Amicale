<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('categorie', 'entity', array(
                'class' => 'AmicaleAccueilBundle:Categorie',
                'property' => 'titre'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\TypeProduit'
        ));
    }

    public function getName()
    {
        return 'amicale_accueilbundle_typeproduittype';
    }
}
