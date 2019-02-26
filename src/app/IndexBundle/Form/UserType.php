<?php

namespace app\IndexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email','email')
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repetir Contraseña'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'app\IndexBundle\Entity\Common\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_indexbundle_user';
    }
}
