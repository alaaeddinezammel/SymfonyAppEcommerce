<?php

namespace Pidev\AllForDealBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReclamationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('sujet')
                ->add('message','textarea')
                ->add('date','hidden')
                
               
                
                ->add('Valider', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pidev\AllForDealBundle\Entity\Reclamation'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pidev';
    }

}
