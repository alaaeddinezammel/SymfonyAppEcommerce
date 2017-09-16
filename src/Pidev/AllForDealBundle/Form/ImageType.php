<?php

namespace Pidev\AllForDealBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('imageFile', 'file')
                ->add('idProduit', 'entity', array('class' => 'PidevAllForDealBundle:Produit', 'property' => 'id'))
                ->add('Upload', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pidev\AllForDealBundle\Entity\Image'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pidev_allfordealbundle_image';
    }

}
