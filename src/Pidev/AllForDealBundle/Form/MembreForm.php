<?php
namespace Pidev\AllForDealBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MembreForm
 *
 * @author Chaima
 */
class MembreForm extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('points')
             ->add('UpDate','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pidev\AllForDealBundle\Entity\Membre'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'Pidev_AllForDealBundle_Membre';
        
    }

//put your code here
}
