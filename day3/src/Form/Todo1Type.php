<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class Todo1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ["attr"=>["class"=>"form-control mb-2", "placeholder"=>"Please type the todo e_name"]])
            ->add('category', null, ["attr"=>["class"=>"form-control mb-2", "placeholder"=>"Please type the category"]])
            ->add('description', TextAreaType::class , ["attr"=>["class"=>"form-control mb-2", "placeholder"=>"Please type the category"]])
            ->add('priority', ChoiceType::class, [
                "choices" => [
                    "movie"=>"movie",
                    "sport"=>"sport",
                    "music" => "music",
                    "theater" => "theater"
                ]
            , "attr" => [
                "class"=> "form-control"
            ]])
            ->add('fk_status', EntityType::class, [
                // looks for choices from this entity
                'class' => Status::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
