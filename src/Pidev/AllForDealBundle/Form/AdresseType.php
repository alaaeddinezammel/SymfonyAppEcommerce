<?php

namespace Pidev\AllForDealBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adresse')
                ->add('cp')
                ->add('pays')
                ->add('ville')
                ->add('complement', null, array('required' => false))
                ->add('Ajouter', 'submit', array('attr' => array('class' => 'btn btn-primary')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pidev\AllForDealBundle\Entity\Adresse'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pidev_allfordealbundle_adresse';
    }

}
