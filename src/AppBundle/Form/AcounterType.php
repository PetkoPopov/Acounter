<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\NumberTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class AcounterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objectName',TextType::class)
            ->add('notice',TextType::class)
            ->add('moneyRecived',NumberType::class)
            ->add('moneyPayed',NumberType::class)
            ->add('itemBuyed1',TextType::class)
            ->add('itemBuyed2',TextType::class)
            ->add('itemBuyed3',TextType::class)
            ->add('itemBuyed4',TextType::class)
            ->add('itemBuyed5',TextType::class)
            ->add('dateWork',DateType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Acounter'
        ));
    }

}
