<?php

namespace covBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\Traits\ValidatorExtensionTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

class offreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',DateType::class,array('widget'=>'single_text'))
            ->add('villeDep')
            ->add('villeArr')
            ->add('nbrePlace',IntegerType::class)
            ->add('heure',\Symfony\Component\Form\Extension\Core\Type\TimeType::class,array('widget'=>'single_text'))
            ->add('prix',IntegerType::class)
            ->add('description',TextareaType::class)
            ->add("nom_voiture")
            ->add("image_voiture",FileType::class,array("empty_data"=>""))
            ->add("Submit",SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'covBundle\Entity\offre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'covbundle_offre';
    }


}
