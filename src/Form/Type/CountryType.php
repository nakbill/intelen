<?php

namespace App\Form\Type;


use App\Entity\Country;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;

class CountryType extends AbstractType
{
    /**
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Country Name',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'minlength' => 2
                ],
                'constraints' => [new Length(['min' => 2, 'max'=>'50'])],
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
            'data_class' => Country::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'author_item',
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => Country::class,
                    'fields' => 'name',
                    'message' => 'The Country name  "{{ value }}" is already in use.',
                ]),
            ]
        ]);
    }
}
