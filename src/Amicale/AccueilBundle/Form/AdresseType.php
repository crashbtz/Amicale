<?php

namespace Amicale\AccueilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', 'integer', array('label' => 'Numéro'))
            ->add('rue', 'text')
            ->add('complements', 'textarea', array('required' => false))
            ->add('code_postal', 'integer', array('label' => 'Code Postal'))
            ->add('ville', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amicale\AccueilBundle\Entity\Adresse'
        ));
    }

    public function getName()
    {
        return 'amicale_accueilbundle_adressetype';
    }
}
