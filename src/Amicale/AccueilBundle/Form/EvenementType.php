<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre', 'text', array('label' => 'Titre *'))
                ->add('detail', 'textarea', array('required' => false, 'label' => 'Détail'))
                ->add('date', 'date')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\Evenement'
        ));
    }

    public function getName() {
        return 'amicale_accueilbundle_evenementtype';
    }

}
