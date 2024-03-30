<?php

namespace App\Form\Type;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Country;
use Symfony\Component\Validator\Constraints\Length;

class AuthorType extends AbstractType
{
    /**
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => ['class' => 'form-control'],
                'constraints' => [new Length(['min' => 2])],
            ])
            ->add('surName', TextType::class, [
                'label' => 'Surname',
                'attr' => ['class' => 'form-control'],
                'constraints' => [new Length(['min' => 2])]
            ])
            ->add('yearOfBirth', DateType::class, [
                'label' => 'Year of Birth',
                'attr' => ['class' => 'form-control'],
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control']
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone',
                'attr' => ['class' => 'form-control']
            ])
            ->add('country', EntityType::class, [
                'label' => 'Country',
                'class' => Country::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('books', CollectionType::class, [
                'entry_type' => BookType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ]);

        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'author_item',
        ]);
    }
}
