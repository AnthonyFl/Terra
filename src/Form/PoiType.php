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
        ->add('POI', TextType::class)
        ->add('description', TextareaType::class)
        ->add('categorie', ChoiceType::class, array(
            'choices' => array(
                'Lac' => 'Lac',
                'Montagne' => 'Montagne',
                'Forêt' => 'Forêt'
        )))
        ->add('adresse', TextareaType::class)
        ->add('ville', TextType::class)
        ->add('region', TextType::class)
        ->add('pays', TextType::class)
        ->add('file', FileType::class, array('required' => false))
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
    
    // /**
    //  * {@inheritdoc}
    //  */
    // public function getBlockPrefix()
    // {
    //     return 'app_poi';
    // }
}