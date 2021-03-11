<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReparationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('comment')
            ->add('image')
            ->add('contact')
            ->add('prix')
            ->add('category', CategoryType::class, ['data_class' => Category::class])
            ->add('ville', VilleType::class, ['data_class' => Ville::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
