<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; //type="submit"

use Symfony\Component\Validator\Constraints as Assert;

class CommentaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('contenu', TextareaType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 20,
                        'minMessage' => 'Le commentaire doit comporter minimum 20 caractères',
                    ))
                )
            ))
           
            -> add('save', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn-info btn-block'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Commentaire'
        ));
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getBlockPrefix()
    // {
    //     return 'app_commentaire';
    // }
}