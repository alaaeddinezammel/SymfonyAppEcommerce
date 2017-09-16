<?php

namespace Pidev\AllForDealBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class OffreForm extends AbstractType  {
public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            ->add('description')
            ->add('lieu')
            ->add('remarque')
            ->add('datedebut')
            ->add('datefin')
           
                ->add('Update','submit')
        ;
    }

    public function getName() {
        return 'Offre';
        
    }

}