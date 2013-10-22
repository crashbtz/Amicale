<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('quantite', 'integer', array('required' => false))
                ->add('user', 'entity', array('class' => 'AmicaleUserBundle:User', 'required' => false))
                ->add('produit', 'entity', array('class' => 'AmicaleAccueilBundle:Produit', 'required' => false))
                ->add('statutCommande', 'entity', array('class' => 'AmicaleAccueilBundle:StatutCommande', 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\Commande'
        ));
    }

    public function getName() {
        return 'amicale_accueilbundle_commandetype';
    }

}
