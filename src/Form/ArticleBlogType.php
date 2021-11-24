<?php

namespace App\Form;

use App\Entity\ArticleBlog;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleBlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre', TextType::class)
            ->add('Contenu', TextType::class)
             ->add('id_category', EntityType::class,[
                 'class'=>Category::class,
                 'choice_label'=>'nom',
                 'multiple' =>false,//si c'est true =checkbox, si false, tu sais choisir juste un truc
                 'expanded'=>false //si false c'est un select, voir tableau ds la doc 
             ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleBlog::class,
        ]);
    }
}
