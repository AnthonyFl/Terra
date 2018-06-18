<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Type="text"
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Type="text"
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // champs select
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; // type "checkbox"
use Symfony\Component\Form\Extension\Core\Type\IntegerType; // type "number"
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // type "Submit"
use Symfony\Component\Form\Extension\Core\Type\FileType; // type "Submit"


class PoiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', TextType::class)
        ->add('POI', TextType::class)
        ->add('lieu', TextType::class)
        ->add('description', TextareaType::class)
        ->add('categorie', TextType::class)
        ->add('file', FileType::class, array('required' => false))
        ->add('adresse', TextareaType::class)
        ->add('ville', TextareaType::class)
        ->add('region', TextareaType::class)
        ->add('pays', TextareaType::class)
        ->add('enregistrer', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'app\Entity\Poi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_poi';
    }
}
