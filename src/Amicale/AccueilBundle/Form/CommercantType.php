<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommercantType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle', 'text', array('label' => 'Libellé *'))
                ->add('nom', 'text', array('required' => false))
                ->add('prenom', 'text', array('required' => false, 'label' => 'Prénom'))
                ->add('detail', 'textarea', array('required' => false, 'label' => 'Détail'))
                ->add('tel', 'integer', array('required' => false, 'label' => 'Téléphone'))
                ->add('email', 'email', array('required' => false))
                ->add('adresse', new AdresseType(), array('required' => false))
                ->add('photo', new PhotoType(), array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\Commercant'
        ));
    }

    public function getName() {
        return 'amicale_accueilbundle_commercanttype';
    }

}
