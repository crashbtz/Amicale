<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre', 'text')
                ->add('marque', 'text', array('required' => false))
                ->add('contenu', 'textarea', array('required' => false))
                ->add('prix', 'integer')
                ->add('typeProduit', 'entity', array(
                    'class' => 'AmicaleAccueilBundle:TypeProduit',
                    'property' => 'nom'))
                ->add('photo', new PhotoType(), array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\Produit'
        ));
    }

    public function getName() {
        return 'amicale_accueilbundle_produittype';
    }

}
