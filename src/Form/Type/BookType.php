<?php

namespace App\Form\Type;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Author;

class BookType extends AbstractType
{
    /**
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => ['class' => 'form-control']
            ])
            ->add('publicationYear', IntegerType::class, [
                'label' => 'Publication Year',
                'attr' => ['class' => 'form-control']
            ])
            ->add('isbn', TextType::class, [
                'label' => 'ISBN',
                'attr' => ['class' => 'form-control']
            ])
            ->add('publisher', TextType::class, [
                'label' => 'Publisher',
                'attr' => ['class' => 'form-control']
            ])
            ->add('author', EntityType::class, [
                'label' => 'Author',
                'class' => Author::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('url', UrlType::class, [
                'label' => 'URL',
                'attr' => ['class' => 'form-control']
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
            'data_class' => Book::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'author_item',
        ]);
    }
}
