<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; //type="text"
use Symfony\Component\Form\Extension\Core\Type\PasswordType; //type="password"
use Symfony\Component\Form\Extension\Core\Type\EmailType; //type="email"
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; //champs select
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; //type="checkbox"
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //type="int"
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; //type="submit"

use Symfony\Component\Validator\Constraints as Assert;

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('username', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max'=> 20,
                        'minMessage' => 'Le pseudo doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le pseudo doit comporter Maximum 20 caractères'
                    )),
                    new Assert\Regex(array(
                        'pattern' => '/^[a-zA-Z-._0-9]+$/',
                        'message' => 'Le pseudo accepte les lettres et les chiffres'
                    )),
                )
            ))
            -> add('password', PasswordType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 8,
                        'minMessage' => 'Le pseudo doit comporter minimum 8 caractères'
                    ))
                )
            ))
            -> add('nom', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max'=> 20,
                        'minMessage' => 'Le nom doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le nom doit comporter Maximum 20 caractères'
                    ))
                )
            ))
            -> add('prenom', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max'=> 20,
                        'minMessage' => 'Le prenom doit comporter minimum 3 caractères',
                        'maxMessage' => 'Le prenom doit comporter Maximum 20 caractères'
                    ))
                )
            ))
            -> add('civilite', ChoiceType::class, array(
                'choices' => array(
                    'Homme' => 'm',
                    'Femme' => 'f'
                )
            ))
            -> add('email', EmailType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Email,
                )
            ))
            -> add('ville', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max'=> 20,
                        'minMessage' => 'La ville doit comporter minimum 3 caractères',
                        'maxMessage' => 'La ville doit comporter Maximum 20 caractères'
                    ))
                )
            ))
            -> add('code_postal', IntegerType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\Type(array(
                        'type' => 'integer',
                        'message' => 'Votre code postal doit être composé de chiffres'
                    )),
                    new Assert\Length(array(
                        'min' => 5,
                        'max' => 5,
                        'minMessage' => 'Votre code postal doit être composé de 5 chiffres',
                        'maxMessage' => 'Votre code postal doit être composé de 5 chiffres'
                    ))
                )
            ))
            -> add('adresse', TextType::class, array(
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank,
                    new Assert\Length(array(
                        'min' => 3,
                        'max'=> 50,
                        'minMessage' => 'L\'adresse doit comporter minimum 3 caractères',
                        'maxMessage' => 'L\'adresse doit comporter Maximum 50 caractères'
                    ))
                )
            ))
            ->add('description', TextareaType::class, array(
                'required' => false
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
            'data_class' => 'App\Entity\Membre'
        ));
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getBlockPrefix()
    // {
    //     return 'app_membre';
    // }
}