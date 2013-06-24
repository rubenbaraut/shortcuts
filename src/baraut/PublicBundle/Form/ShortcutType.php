<?php

namespace baraut\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShortcutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('command')
            ->add('description')
            ->add('plataform','choice',array('empty_value'=>'Plataforma','choices'=>array('MacOS'=>'MacOS','Windows'=>'Windows','Linux'=>'Linux','Iphone'=>'Iphone','Android'=>'Android','Totes'=>'Totes')))
            ->add('program')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'baraut\PublicBundle\Entity\Shortcut'
        ));
    }

    public function getName()
    {
        return 'baraut_publicbundle_shortcuttype';
    }
}
